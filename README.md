# Projet-PHP-B2

* [I. Installation Homestead](##-Intallation-Homestead)
* [II. Connecter sa base de données](##-Connecter-sa-base-de-données)
 

<a name="section-1"></a>

Installer composer

Installer homestead

---
## I. Installation Homestead


### Prérequis

- Avoir VirtualBox
- Avoir Vagrant
- Avoir Git bash

### Installation

Dans votre Powershell entrez la commande suivante :

```powerhsell
vagrant box add laravel/homestead --force
```
Cela installera la box vagrant de homestead

Ensuite dans la console git bash, rentrez la commande suivante :

```git
git clone https://github.com/laravel/homestead.git ~/Homestead
```
Cela va créer le dossier Homestead dans votre dossier Users.

Allez ensuite dans votre dossier Homestead :

```bash
cd ~/Homestead
```

Puis entrez la commande suivante :
```bash
bash init.sh
```
Ensuite rentrez la commande suivante :

```bash
cd ~ && ssh-keygen -t rsa -C 'moncourriel@mondomaine.com'
```

La commande vous fera revenir dans votre dossier personnel puis vous permettre de générer une clé SSH pour que votre ordinateur puisse accèder à la machine virtuelle.

Ensuite, éditez Homestead.yaml :

```bash
folders:

    - map: ~/Documents/onlineChat

      to: /home/vagrant/code
```

Dans le map, vous mettrez le chemin de votre dossier Laravel dedans.

Mettez vous dans votre dossier `C:\Users\tuto\Documents\` puis rentrez la commande :
```bash
git clone https://github.com/Saluc00/Projet-PHP-B2.git onlineChat
```

Allez maintenant dans votre dossier Homestead et lancer la commande :
```bash
vagrant up
```
Ensuite faites :
```bash
vagrant ssh
```

```bash
cd /code
```
```bash
composer install

```
```bash
php artisan migrate:fresh --seed
```

Puis dans votre console, rentrez
Vous pouvez maintenant vous connectez avec votre navigateur à l'url `192.168.10.10`, vous devriez y voir la page d'accueil de Laravel.

---

## Connecter sa base de données

Pour connectez votre base de données à votre projet vous devez modifier le fichier `.env` se trouvent dans votre dossier `onlineChat`.

Vous devez modifier ces lignes pour pouvoir vous connecter à votre base de données :

```bash
DB_CONNECTION=mysql
DB_HOST=192.168.10.10
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
Pour la doc sur les fonctionalité : 
