--
-- Type énuméré
--

create type TStatutCommande as enum ('passee', 'preteAComposer', 'enCompostion', 'compositionValidee', 'enLivraison', 'Livree', 'miseDeCote', 'Echouee');

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
    email varchar not null,
    identifiant varchar not null,
    mdp varchar not null,
    numTel int not null,
    nbPointFidelite int default 0 not null,
    primary key (idPersonne)
);

drop table if exists client;
create table if not exists client (
    idPersonne serial not null,
    statutCLient TClient default 'active' not null,
    nbCommandeEchouee int not null,
    primary key (idPersonne)
);

drop table if exists employe;
create table if not exists employe (
    idPersonne serial not null,
    matricule int not null UNIQUE,
    primary key (idPersonne)
);

drop table if exists commande;
create table if not exists commande (
    idCommande serial not null,
    idClient serial not null,
    idPreparateur serial,
    dateCommande date,
    heureCommande time,
    heureMaxPaiement time,
    montantPaiement money default 0 not null,
    nbPointUtilise int default 0 not null,
    statutCommande TStatutCommande not null,
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
    idLivreur serial,
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

insert into produit (libelle,qteActuelle,qteFixeRepro,prixUnitaire) values
('ordinateur',200,400,600),
('video game',250,600,300),
('telephone portable',700,500,550),
('télévision',350,550,800),
('airpods',390,750,400),
('machine à laver',250,420,300);,
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

insert into commande (idClient ,idPreparateur, dateCommande ,heureCommande ,heureMaxPaiement ,montantPaiement , nbPointUtilise ,statutCommande TStatutCommande) values
(1,11,'2022-04-19', '10:00:00' ,'22:00:00',300,5,'preteAComposer'),
(2,12,'2022-04-11', '10:00:00' ,'22:00:00',400,5,'enCompostion'),
(3,13,'2022-04-12', '10:00:00' ,'22:00:00',600,5,'compositionValidee'), 
(4,14,'2022-04-13', '10:00:00' ,'22:00:00',300,10,'enLivraison'), 
(5,15,'2022-04-14', '10:00:00' ,'22:00:00',400,4,'enCompostion'), 
(6,16,'2022-04-15', '10:00:00' ,'22:00:00',600,5,'compositionValidee');

insert into client (idPersonne,statutClient,nbCommandeEchoue) values 
(1,'active',0),
(2,'active',1)
(3,'bloque',4),
(4,'active',2),
(5,'bloque',5),
(6,'active',1),
(7,'bloque',5),
(8,'active',1);

insert into planningLivraison (idCommande ,idLivreur, dateLivraison ,heureLivraison ,quai) values
(1,17,'2022-04-10','11:00:00',2),
(2,16,'2022-04-11','12:00:00',4),
(3,15,'2022-04-11','11:00:00',3),
(4,17,'2022-04-12','12:00:00',1),
(5,16,'2022-04-13','13:00:00',5);

insert into contient (idProduit ,idCommande ,qteProduit) values 
(1,1,1),
(2,2,3),
(3,3,2),
(4,4,5),
(5,5,4),
(6,6,3);

insert into employe (idPersonne,matricule) values
(11,447183),
(12,478546),
(13,447856),
(14,497854),
(15,478955),
(16,485210),
(17,492582);