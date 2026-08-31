# TestStrategy

## Présentation

**TestStrategy** est un projet personnel ayant pour objectif principal de mettre en pratique, tester et améliorer les méthodologies de tests acquises lors de différentes formations suivies sur **LinkedIn Learning**.

Le projet consiste à développer un serveur de prise de rendez-vous permettant à des utilisateurs de créer leur propre agenda de disponibilités et de partager un lien afin que d'autres personnes puissent réserver un rendez-vous.

L'objectif n'est donc pas uniquement de développer une fonctionnalité de prise de rendez-vous, mais également de disposer d'un projet suffisamment complet pour appliquer différentes stratégies et méthodologies de tests tout au long de son développement.

---

## Objectifs du projet

Le projet a plusieurs objectifs :

* Mettre en pratique les méthodologies de tests étudiées en formation.
* Tester différentes fonctionnalités dans des situations réalistes.
* Identifier et corriger les problèmes rencontrés lors du développement.
* Améliorer progressivement la qualité et la fiabilité du serveur.
* Mettre en place un système complet de prise de rendez-vous.
* Permettre à chaque utilisateur de créer et gérer son propre agenda de rendez-vous.

---

# Fonctionnement général

Le serveur permet à une personne disposant d'un agenda de rendez-vous de partager un lien personnel.

Ce lien peut ensuite être transmis à d'autres personnes afin qu'elles puissent consulter les disponibilités et réserver un rendez-vous.

La prise de rendez-vous peut être effectuée :

* par un utilisateur non connecté ;
* par un utilisateur connecté.

Les fonctionnalités disponibles dépendent du statut de l'utilisateur.

---

# Utilisateur non connecté

Une personne n'ayant pas de compte peut utiliser un lien de prise de rendez-vous qui lui a été transmis par le détenteur d'un agenda.

Elle peut alors :

1. Accéder à la page de prise de rendez-vous.
2. Consulter les créneaux disponibles.
3. Sélectionner un créneau.
4. Renseigner les informations nécessaires à la réservation.
5. Valider sa demande de rendez-vous.

Avant de valider le rendez-vous, le serveur doit effectuer plusieurs vérifications.

### Vérification des disponibilités

Le serveur doit notamment vérifier que :

* le créneau sélectionné est toujours disponible ;
* le détenteur de l'agenda est disponible pendant cette période ;
* aucun rendez-vous existant n'occupe déjà le créneau ;
* le créneau respecte les règles de disponibilité configurées par le détenteur de l'agenda.

Une fois toutes les vérifications effectuées, le rendez-vous peut être enregistré.

Le serveur envoie alors un e-mail au détenteur de l'agenda afin de l'informer qu'une demande de rendez-vous a été effectuée.

Le détenteur de l'agenda peut ensuite accepter ou refuser le rendez-vous.

---

# Utilisateur connecté

Un utilisateur possédant un compte peut utiliser les fonctionnalités disponibles pour les utilisateurs non connectés, tout en bénéficiant de fonctionnalités supplémentaires.

Il peut notamment :

* prendre des rendez-vous ;
* consulter son historique de rendez-vous ;
* conserver ses rendez-vous associés à son compte ;
* créer son propre agenda de prise de rendez-vous.

Lorsqu'un utilisateur connecté prend un rendez-vous, celui-ci est automatiquement associé à son compte.

---

# Création d'un agenda

Chaque utilisateur connecté peut créer son propre agenda de prise de rendez-vous.

Un agenda possède un lien unique permettant de partager facilement la page de réservation avec d'autres personnes.

Le détenteur de l'agenda peut configurer plusieurs paramètres.

## Durée des rendez-vous

Le détenteur de l'agenda peut définir la durée d'un rendez-vous.

Par exemple :

* 15 minutes ;
* 30 minutes ;
* 45 minutes ;
* 1 heure.

Cette durée est utilisée par le serveur pour déterminer les créneaux pouvant être proposés aux personnes souhaitant prendre un rendez-vous.

## Temps entre les rendez-vous

Le détenteur de l'agenda peut également définir une durée de séparation entre deux rendez-vous.

Cette durée permet, par exemple, de prévoir un temps de pause ou de préparation entre deux rendez-vous.

## Disponibilités hebdomadaires

Pour chaque jour de la semaine, le détenteur de l'agenda peut définir ses horaires de disponibilité.

Il peut ainsi indiquer, par exemple :

* l'heure de début de disponibilité ;
* l'heure de fin de disponibilité.

Le serveur utilise ces informations pour générer les créneaux pouvant être réservés.

Le détenteur de l'agenda doit également pouvoir indiquer des périodes pendant lesquelles il n'est exceptionnellement pas disponible.

Ces périodes doivent être prises en compte lors de chaque réservation.

---

# Personnalisation de l'agenda

Le détenteur d'un agenda peut personnaliser la page de prise de rendez-vous.

Une fonctionnalité permet notamment d'ajouter un bloc HTML personnalisé à la page.

Cette fonctionnalité est facultative.

Elle peut permettre au détenteur de l'agenda d'ajouter du contenu supplémentaire, comme :

* une présentation ;
* des informations complémentaires ;
* des consignes avant le rendez-vous ;
* des informations de contact.

---

# Gestion des rendez-vous

Lorsqu'une personne réserve un rendez-vous, le serveur effectue l'ensemble des vérifications nécessaires avant son enregistrement.

Le processus doit notamment être capable de vérifier :

1. La validité des informations fournies.
2. La disponibilité du créneau demandé.
3. Les horaires de disponibilité du détenteur de l'agenda.
4. Les périodes d'indisponibilité enregistrées.
5. Les autres rendez-vous déjà présents.
6. Le respect de la durée configurée pour les rendez-vous.
7. Le respect du délai configuré entre deux rendez-vous.

Une fois ces vérifications terminées, le rendez-vous est enregistré en base de données.

---

# Notifications par e-mail

Le serveur utilise les e-mails afin d'informer les différents utilisateurs des événements liés aux rendez-vous.

## Notification du détenteur de l'agenda

Lorsqu'un rendez-vous est demandé, le détenteur de l'agenda reçoit un e-mail l'informant de la réservation.

Il peut ensuite accepter ou refuser le rendez-vous.

## Notification de l'utilisateur

Une fois le rendez-vous validé, un e-mail est envoyé à la personne ayant effectué la réservation.

Les utilisateurs connectés peuvent également choisir de recevoir un rappel avant leur rendez-vous.

Cette fonctionnalité est facultative et dépend du choix effectué par l'utilisateur.

---

# Partage d'un agenda

Chaque agenda possède un lien permettant d'accéder directement à sa page de prise de rendez-vous.

Le détenteur peut transmettre ce lien aux personnes auxquelles il souhaite permettre de prendre un rendez-vous.

Une fonctionnalité supplémentaire permet également au détenteur de l'agenda d'envoyer directement un e-mail contenant le bon lien de prise de rendez-vous.

Cette fonctionnalité a pour objectif de simplifier le partage de l'agenda.

---

# Page d'accueil

La page d'accueil présente le principe général du projet et explique brièvement son fonctionnement.

Elle permet notamment de comprendre l'objectif du serveur et le fonctionnement général de la prise de rendez-vous.

Un lien situé en bas de la page permet à un utilisateur de créer son propre agenda de prise de rendez-vous.

---

# Structure fonctionnelle

Les fonctionnalités du projet peuvent être regroupées en plusieurs catégories.

### Visiteur

* Accéder à la page d'accueil.
* Consulter l'explication du fonctionnement du serveur.
* Accéder à un agenda via son lien.
* Consulter les créneaux disponibles.
* Prendre un rendez-vous sans créer de compte.

### Utilisateur connecté

Toutes les fonctionnalités d'un visiteur, ainsi que :

* gérer son compte ;
* prendre des rendez-vous ;
* conserver un historique de ses rendez-vous ;
* recevoir des notifications et rappels par e-mail selon ses préférences ;
* créer un agenda de prise de rendez-vous.

### Détenteur d'un agenda

Toutes les fonctionnalités d'un utilisateur connecté, ainsi que :

* créer un agenda ;
* définir la durée des rendez-vous ;
* définir le temps entre deux rendez-vous ;
* définir ses horaires de disponibilité pour chaque jour ;
* définir des périodes d'indisponibilité ;
* personnaliser la page de prise de rendez-vous avec un bloc HTML facultatif ;
* partager son lien de prise de rendez-vous ;
* envoyer directement le lien de son agenda par e-mail ;
* recevoir les demandes de rendez-vous par e-mail ;
* accepter ou refuser les rendez-vous.

---

# Base de données

Les données nécessaires au fonctionnement du serveur sont enregistrées en base de données.

Elle doit notamment permettre de conserver :

* les comptes utilisateurs ;
* les agendas ;
* les disponibilités ;
* les périodes d'indisponibilité ;
* les rendez-vous ;
* les préférences de notification ;
* les informations nécessaires à l'envoi des e-mails.

La structure exacte de la base de données pourra évoluer au cours du développement en fonction des besoins identifiés pendant les différentes phases de test.

---

# Stratégie de tests

Le projet **TestStrategy** est avant tout un projet d'expérimentation autour des méthodologies de tests.

Les différentes fonctionnalités doivent donc être développées avec l'objectif de pouvoir être testées dans de nombreuses situations.

Les tests pourront notamment porter sur :

* la création d'un compte ;
* la connexion ;
* la création d'un agenda ;
* la configuration des disponibilités ;
* la création de périodes d'indisponibilité ;
* la génération des créneaux ;
* la prise d'un rendez-vous ;
* la prise d'un rendez-vous par un utilisateur connecté ;
* la prise d'un rendez-vous par un utilisateur non connecté ;
* la gestion des conflits entre rendez-vous ;
* l'acceptation d'un rendez-vous ;
* le refus d'un rendez-vous ;
* l'envoi des e-mails ;
* les rappels ;
* la personnalisation des pages d'agenda ;
* le partage des agendas.

Une attention particulière devra être portée aux cas limites, notamment lorsque plusieurs personnes tentent de réserver simultanément le même créneau.

---

# Évolution du projet

Le projet est conçu pour évoluer progressivement.

De nouvelles fonctionnalités pourront être ajoutées afin de permettre l'expérimentation de nouvelles méthodologies de tests et de mettre davantage le serveur à l'épreuve.

L'objectif final est d'obtenir un serveur de prise de rendez-vous fonctionnel tout en disposant d'une base de tests permettant d'évaluer la fiabilité, la robustesse et la qualité du projet.
