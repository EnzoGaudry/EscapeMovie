drop database if exists escape_movie;
create database escape_movie;
use escape_movie;

create table scenarios(id INT primary key auto_increment not null, 
name varchar(255) not null, 
description TEXT not null, 
realised_by varchar(255) not null, 
image_name text);

create table cards(id INT primary key auto_increment not null, 
name varchar(255) not null, 
card_number int not null, 
text TEXT not null, 
image_name text , 
scenario_id int, 
foreign key (scenario_id) 
references scenarios(id)
ON DELETE CASCADE);

INSERT INTO scenarios VALUES (2, 'Gloria', 'Poursuivie par la mafia il faut quitter New York', 'Escape-Movie Team', 'gloriaffiche.jpg');
INSERT INTO cards (name, card_number, text, image_name, scenario_id)
 VALUES
 ('Dans un immeuble', 1, 'Vous êtes Gloria. Ce matin il vous manque du café. 
 Vous allez chez la voisine pour en récupérer. Piochez la carte 2.', 'gloria.jpg', 2),
 ('La voisine', 2, 'Votre voisine ouvre la porte d’un air affolée.
 Elle vous confie son fils Phil et vous demande de le mettre à l’abri chez vous.
 Piochez la carte 6 et rendez vous à votre appartement porte 76.', 'voisine.jpg', 2),
 ('Votre Chat', 8, 'Il ronronne! (Vous pouvez associer le chiffre de cette carte à celui de la carte de Phil pour tenter de le calmer).', 'chat.jpg', 2),
 ('Revolver', 5, 'Six coup mais seulement 5 balles. (Si vous avez le carnet: combinez les nombres de la carte revolver et du carnet pour vous enfuir) Défaussez la carte 7.', 'revolver.jpg', 2),
 ('Phil', 6, 'Phil est un garçon de 6 ans. Il tiens un carnet dans ses mains.
 Il semble stressé et ne lâche pas son carnet.', 'phil.jpg', 2),
 ('Armoire', 7, 'Dans cette armoire il y a un sac avec quelques vêtements et un revolver: il contient 5 balles.', 'armoire.jpg', 2),
 ('Téléviseur', 4, 'Un poste TV. L’ami des enfants? (Vous pouvez associer le chiffre de cette carte à celui de la carte de Phil pour tenter de le calmer).', 'tv.jpg', 2),
 ('Raté', 10, 'Cela ne semble aoir aucun effet(Si la combinaison de deux carte n’existe pas vous n’aurez tout simplement pas de carte).', 'raté.jpg', 2),
 ('Phil se calme', 14, 'Il vous laisse son carnet (piocher la carte 40). Des coups de feu se font entendre, vous êtes en danger. Cherchez un moyen de quitter l’immeuble.
 (vous pouvez défausser les carte 8, 4 et 10)', 'calme.jpg', 2),
 ('Carnet', 40, 'Ce carnet comporte des éléments comptable de la mafia.(Défaussez la carte 14)', 'carnet.jpg', 2),
 ('Fuite', 45, 'Vous fuyez l’immeuble avec Phil, vous cherchez un taxi. Défaussez la carte 76.', 'fuite.jpg', 2),
 ('Taxi', 306, 'Vous vous échappez. Il va falloir trouver un lieu de repli pour réfléchir à la prochaine action. Piocher 24 pour aller à un hôtel bien noté ou piocher 16 pour un hôtel miteux.', 'taxi.jpg', 2),
 ('Votre appartment', 76, 'Il y a un téléviseur et votre chat qui vous accueille. Vous avez dans votre chambre une armoire avec vos biens les plus précieux. Vous pouvez piocher les cartes 8, 4, 7 et défausser la carte 2.', 'appartement.jpg', 2);

INSERT INTO scenarios VALUES ('1', 'Tutoriel', "Partie rapide pour vous montrez le déroulement d'une partie", 'Admin', 'tuto_image_scenario.jpg');
INSERT INTO cards (name, card_number, text, scenario_id, image_name) VALUES 
("Porte fermée du Tutoriel", "1", "Pour cette première carte rien de spécial piochez la carte numéro 4 grâce a la pioche.", '1', 'tuto_image_1.jpg'),
("Clé", "4", "Cette seconde carte pourrait t'aider a ouvrir la porte non ? Additionne le numéro de carte de la porte et celui de la clé, numéro qui se trouve en haut à droite.", '1', 'tuto_image_2.jpg'),
("Accueil du Tutoriel", "5", "Bien joué voici la mécanique de base pour jouer. Avec ces 3 cartes tu peux découvrir une suite.", '1', 'tuto_image_3.jpg'),
("Salle d'information", "10", "Oh je vois que tu as compris cette mécanique, sache que ce serait possible avec les images.", '1', 'tuto_image_4.jpg'),
("Narnia", "18", "Bravo a vous d'avoir trouvé cet Easter Egg", '1', 'tuto_image_5.jpg');
