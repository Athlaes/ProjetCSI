--
-- Type énuméré
--

create type TStatutCommande as enum ('passee', 'preteAComposer', 'enComposition', 'compositionValidee', 'enLivraison', 'Livree', 'miseDeCote', 'Echouee');

create type TClient as enum ('active', 'bloque');

--
-- Structure des tables 
--

drop table if exists produit;
create table if not exists produit (
    idProduit serial not null,
    libelle varchar not null,
    qteActuelle int not null,
    qteFixeReapro int not null,
    prixUnitaire money not null,
    descriptionP varchar default 'A venir' not null,
    primary key (idProduit)
);

drop table if exists personne;
create table if not exists personne (
    idPersonne serial not null,
    nom varchar not null,
    prenom varchar not null,
    rue varchar not null,
    ville varchar not null,
    cp int not null,
    email varchar not null UNIQUE,
    identifiant varchar not null UNIQUE,
    mdp varchar not null,
    numTel int not null,
    nbPointFidelite int default 0 not null,
    primary key (idPersonne)
);

drop table if exists client;
create table if not exists client (
    idPersonne serial not null,
    statutCLient TClient default 'active' not null,
    nbCommandeEchouee int default 0 not null,
    primary key (idPersonne)
);

drop table if exists employe;
create table if not exists employe (
    idPersonne serial not null,
    matricule int not null UNIQUE,
    responsable boolean not null default false,
    primary key (idPersonne)
);

drop table if exists commande;
create table if not exists commande (
    idCommande serial not null,
    idClient serial not null,
    idPreparateur int,
    dateCommande date,
    heureCommande time,
    heureMaxPaiement time,
    montantPaiement money default 0 not null,
    nbPointUtilise int default 0 not null,
    statutCommande TStatutCommande not null default 'passee',
    primary key (idCommande)
);

drop table if exists contient;
create table if not exists contient(
    idProduit serial not null,
    idCommande serial not null,
    qteProduit int default 1 not null,
    primary key (idProduit, idCommande),
    constraint CHK_qteProduit CHECK (qteProduit >= 1)
);

drop table if exists planningLivraison;
create table if not exists planningLivraison (
    idLivraison serial not null,
    idCommande serial not null,
    idLivreur int,
    dateLivraison date,
    heureLivraison time,
    quai int,
    primary key (idLivraison)
);

--
-- Contraintes sur tables 
--

alter table commande 
    add constraint fk_employe_commande foreign key (idPreparateur) references employe (idPersonne),
    add constraint fk_client_commande foreign key (idClient) references client (idPersonne);

alter table planningLivraison 
    add constraint fk_commande_livraison foreign key (idCommande) references commande (idCommande),
    add constraint fk_employe_livraison foreign key (idLivreur) references employe (idPersonne);

alter table client 
    add constraint fk_personne_client foreign key (idPersonne) references personne (idPersonne);

alter table employe
    add constraint fk_personne_employe foreign key (idPersonne) references personne (idPersonne);

alter table contient
    add constraint fk_commande_contient foreign key (idCommande) references commande (idCommande),
    add constraint fk_produit_contient foreign key (idProduit) references produit (idProduit);

--
-- Chargement des valeurs dans les tables
--

insert into produit (libelle,qteActuelle,qteFixeReapro,prixUnitaire) values
('ordinateur',200,400,600),
('video game',250,600,300),
('telephone portable',700,500,550),
('télévision',350,550,800),
('airpods',390,750,400),
('machine à laver',250,420,300),
('aspirateur',800,360,300);

insert into personne (nom, prenom, rue, ville, cp, email, identifiant, mdp, numTel, nbPointFidelite) values
('paul','muller', '12 rue anatole', 'nancy', 45000, 'paul.muller@gmail.com', 'pk15', '01234', '0712654787', 5),
('luca' ,'debreux' ,'18 rue de quai'  ,'nancy' ,45000 ,'luca.debreux@gmail.com' ,'ld20' ,'01452' ,'0621567077' ,6),
('didier' ,'azul' ,'195 rue de laxou' ,'nancy' ,45000 ,'didier.azul@gmail.com' ,'dz03' ,'12346' ,'0669126705' ,10),
('lea' ,'cloe' ,' 4 rue charlemagne' ,'nancy' ,45000 ,'lea.cloe@gmail.com' ,'lc98' ,'54687' ,'0718162077' ,15),
('olivia' ,'xu' ,'9 rue anatole' ,'nancy' ,45000 ,'olivia.xu@gmail.fr' ,'olx96' ,'020103' ,'0678905018' ,8),
('kevin' ,'mavuba' ,'80 rue sain jean' ,'nancy',45000 ,'kevin.mavuba@gmail.com' ,'km94' ,'504060' ,'0745558725' ,7),
('francois' ,'holland' ,'12 rue sain dezier' ,'nancy' ,45000, 'francois.holland@gmail.com' ,'fh45' ,'081245' ,'0645127803' ,10),
('fatma' ,'sellami' ,'9 rue jacquinoit' ,'nancy' ,45000, 'fatma.sellami@gmail.com' ,'fs04' ,'362514' ,'0678956231' ,15);

insert into client (idPersonne,statutClient,nbCommandeEchouee) values 
(1,'active',0),
(2,'active',1),
(3,'bloque',4),
(4,'active',2),
(5,'bloque',5);

insert into employe (idPersonne,matricule) values
(6,447183),
(7,478546),
(8,447856);

insert into commande (idClient, idPreparateur, dateCommande, heureCommande, heureMaxPaiement,  montantPaiement, nbPointUtilise, statutCommande) values
(1,8,'2022-04-19', '10:00:00','22:00:00', 300, 5, 'preteAComposer'),
(2,8,'2022-04-11', '10:00:00','22:00:00', 400, 5, 'enComposition'),
(3,8,'2022-04-12', '10:00:00','22:00:00', 600, 5, 'compositionValidee'), 
(4,8,'2022-04-13', '10:00:00','22:00:00', 300, 10, 'enLivraison'), 
(5,8,'2022-04-14', '10:00:00','22:00:00', 400, 4, 'enComposition'), 
(1,8,'2022-04-15', '10:00:00','22:00:00', 600, 5, 'compositionValidee');


insert into planningLivraison (idCommande ,idLivreur, dateLivraison ,heureLivraison ,quai) values
(1, 6, '2022-04-10', '11:00:00', 2),
(2, 7, '2022-04-11', '12:00:00', 4),
(3, 7, '2022-04-11', '11:00:00', 3),
(4, 7, '2022-04-12', '12:00:00', 1),
(5, 6, '2022-04-13', '13:00:00', 5);

insert into contient (idProduit ,idCommande ,qteProduit) values 
(1,1,1),
(2,2,3),
(3,3,2),
(4,4,5),
(5,5,4),
(6,6,3);


--
-- Contraintes d'intégrité
--

--- procédure éxecuté périodiquement toutes les heures 
-- vérification des paiements 12h après avoir passé la commande
create function verifier_paiement() returns void as $$
Declare 
	r commande%rowtype;
begin
for r in 
	SELECT * FROM commande 
	where (current_date >= commande.datecommande and current_time >= commande.heuremaxpaiement) 
		and (commande.statutcommande='passee')
	loop
		update commande set statutcommande= 'Echouee';
	end loop;
end
$$ language plpgsql;

-------------------------------------------------------------------
-- procédure éxecuté tous les ans
-- 

create function remise_zero () returns void as $$
begin
update personne
set nbPointFidelite = 0;
end
$$ language plpgsql;

-------------------------------------------------------------------
-- procédure éxecuté chaque fermeture de magasin
--

create function echec_commande() returns void as $$
Declare 
	r commande%rowtype;
	i contient%rowtype;
begin 
	for r in
		select * from commande where statutcommande = 'miseDeCote'
		loop
			update commande set statutcommande = 'Echouee';
			for i in 
				select * from contient where idcommande = r.idcommande			
			loop
				update produit set qteactuelle = (select qteactuelle from produit where idproduit = i.idproduit and idcommande= r.idcommande)+i.qteproduit;
				delete from contient where idproduit = i.idproduit and idcommande = r.idcommande;  
			end loop;
		end loop;
end
$$ language plpgsql;

--------------------------------------------------------------------
create or replace function modif_heure() returns trigger as $$
begin
if new.heureLivraison - old.heureLivraison <= interval '30 minutes' Then 
raise exception 'La nouvelle heure de Livraision doit être au moins 30 plus tard que celle initiale';
End if
end;

$modif_heure$ language plpgsql;

Create trigger modification_heure Before update on plannigLivraison
	For each row execute procedure modif_heure();

---------------------------------------------------------------------

create or replace function bloquer_client() returns trigger as $$
declare 
num_personne int;
begin
if new.nbCommandeEchouee >= 3 then
	statutCLient='Bloque';
End if;
return new;
end
$$ language plpgsql;
create trigger statut_ClientBloque before insert on commande for each row
execute procedure bloquer_client();

--------------------------------------------------------------

create or replace function add_points() returns trigger as $$
declare 
nbpoint int;
numcommande int;
begin
if (select StautCommande from commande where commande.idCommande=numcommande)='preteAComposer' then
	new.nbPointFidelite=old.nbPointFidelite+nbpoint;
End if;
return new;
end
$$ language plpgsql;

create trigger nb_points_fidelite after update on commande for each row
execute procedure add_points();
