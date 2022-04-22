<?php 
class PdoDrive {
    private static $monPdo;
    private static $monPdoDrive;

    private function __construct(){
        try {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''); 
            PdoDrive::$monPdo = new PDO(DSN, DB_USER, DB_PWD, $options);
            PdoDrive::$monPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __destruct(){
        PdoDrive::$monPdo = null;
    }

    public static function getPdoDrive(){
        if(PdoDrive::$monPdoDrive == null){
            PdoDrive::$monPdoDrive = new PdoDrive();
        }
        return PdoDrive::$monPdoDrive;
    }

    public static function ajouterUtilisateur($user){
        try{
            $requete = PdoDrive::$monPdo->prepare('insert into Personne (nom, prenom, nom, rue, ville, cp, email, identifiant, mdp, numTel) values (:nom, :prenom, :nom, :rue, :ville, :cp, :email, :identifiant, :mdp, :numTel)');
            $requete->bindParam(':nom', $user->nom, PDO::PARAM_STR);
            $requete->bindParam(':prenom', $user->prenom, PDO::PARAM_STR);
            $requete->bindParam(':rue', $user->rue, PDO::PARAM_STR);
            $requete->bindParam(':ville', $user->ville, PDO::PARAM_STR);
            $requete->bindParam(':cp', $user->cp, PDO::PARAM_INT);
            $requete->bindParam(':email', $user->email, PDO::PARAM_STR);
            $requete->bindParam(':identifiant', $user->identifiant, PDO::PARAM_STR);
            $requete->bindParam(':mdp', $user->mdp, PDO::PARAM_STR);
            $requete->bindParam(':numTel', $user->numTel, PDO::PARAM_STR);
            $requete->execute();
            $id = PdoDrive::$monPdo->lastInsertId();
            $requete_client = PdoDrive::$monPdo->prepare('insert into client (idPersonne) values (:id)');
            $requete_client->bindParam(':id', $id, PDO::PARAM_INT);
            $requete_client->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getPassword($email){
        try {
            $requete = PdoDrive::$monPdo->prepare('select idpersonne, mdp from personne where email like :email');
            $requete->bindParam(':email', $email,PDO::PARAM_STR);
            $requete->execute();
            $user = $requete->fetch();
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public static function getUserInformation($id){
        try {
            $requete = PdoDrive::$monPdo->prepare('select * from personne where idpersonne = :id');
            $requete->bindParam(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $user = $requete->fetch();
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getProduits(){
        try {
            $requete = PdoDrive::$monPdo->prepare('select * from produit');
            $requete->execute();
            $tbProduits = $requete->fetchAll();
            return $tbProduits;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getProduit($id){
        try {
            $requete = PdoDrive::$monPdo->prepare('select * from produit where idproduit = :id');
            $requete->bindParam(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $produit = $requete->fetch();
            return $produit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function validerCommande($montant, $nbPoint){
        try{
            $requete = PdoDrive::$monPdo->prepare("insert into commande (idclient, datecommande, heurecommande, heuremaxpaiement, montantpaiement, nbpointutilise) values (:idClient, CURRENT_DATE, CURRENT_TIME, CURRENT_TIME+interval '12 hours', :montant, :nbPoint);");
            $requete->bindParam(':id', $_SESSION['UserConnecte']->idpersonne, PDO::PARAM_INT);
            $requete->bindParam(':montant', $montant, PDO::PARAM_INT);
            $requete->bindParam(':nbPoint', $nbPoint, PDO::PARAM_INT);
            $requete->execute();
            $idCommande = PdoDrive::$monPdo->lastInsertId();
            foreach ($_SESSION['Panier'] as $produit) { 
                $requete = PdoDrive::$monPdo->prepare('insert into contient (idproduit, idcommande, qteproduit) values (:idProduit, :idCommande, :qteProduit);');
                $requete->bindParam(':idProduit', $produit->idproduit, PDO::PARAM_INT);
                $requete->bindParam(':idCommande', $idCommande, PDO::PARAM_INT);
                $requete->bindParam(':qteProduit', $produit->qte, PDO::PARAM_INT);
                $requete->execute();
            }
        } catch (PDOException $e){  
            echo $e->getMessage();
        }

    }

    public static function getCommandes() {
        try {
            $tbCommandesProduits = array();
            $requeteCommande = PdoDrive::$monPdo->prepare('select * from commande com where idclient = :idClient');
            $requeteCommande->bindParam(':idClient', $_SESSION['UserConnecte']->idpersonne, PDO::PARAM_INT);
            $requeteCommande->execute();
            $tbCommandes = $requeteCommande->fetchAll();
            foreach ($tbCommandes as $commande) {
                $requeteProduit = PdoDrive::$monPdo->prepare('select * from contient right join produit p on p.idproduit = contient.idproduit where idcommande = :idCommande;');
                $requeteProduit->bindParam(':idCommande', $commande->idcommande, PDO::PARAM_INT);
                $requeteProduit->execute();
                $tbProduits = $requeteProduit->fetchAll();
                $ptbCommandeProduits['Commande'] = $commande;
                $ptbCommandeProduits['Produits'] = $tbProduits;
                array_push($tbCommandesProduits, $ptbCommandeProduits);
            }

            return $tbCommandesProduits;
        } catch (PDOException $e){  
            echo $e->getMessage();
        }
    }    
}