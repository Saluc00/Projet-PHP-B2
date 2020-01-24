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

# Tchat en direct
## Comment ça fonctionne ?

Voici le code JS
```
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        function reload(nbrMessagePrecendent) {
            // affiche BDD
            $.get("http://192.168.10.10/messageDB/{{$id}}-{{$id2}}", function (data) {
                const nbrMessageActuel = data.length
                if (nbrMessageActuel > nbrMessagePrecendent) {
                    console.log(data[0])
                    $('.messageEnDirect').append('<div class="msg" style="text-overflow: ellipsis; word-wrap: break-word;">' +
                        '                    <p>' +
                        '                        <a href=\"/profile/' + data[0].user_id + '\">' + data[0].pseudo + ' </a>: ' + data[0].content +
                        '                    </p>' +
                        '                </div>');
                    scrollEnBas = document.getElementById('text-msg');
                    scrollEnBas.scrollTop = scrollEnBas.scrollHeight;
                }
                setTimeout(reload(nbrMessageActuel));
            }, 'json')
        }

        const lien = document.getElementById("monform").action
        console.log(lien)
        document.getElementById('button-addon1').addEventListener('click', function (e) {
            e.preventDefault();
            let msg = {'message': document.getElementById('text').value}
            $.ajax({
                url: lien,
                data: msg,
                type: 'POST',
                // Ici quand la requete fonctionne faire une action !
                //success: ,
                dataType: 'json',
            })
            $('#text').val('')
        })
        $('#text').val('')
        $.get("http://192.168.10.10/messageDB/{{$id}}-{{$id2}}", function (data) {
            reload(data.length)
        }, 'json')
```

Pour que les requetes ajax fonctionnent, il me faut ajouter se bout de code
```
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
```
Pourquoi ? Car laravel bloque les requete en ajax autrement..

### Comment récuperer les données ?
La fonctione **Reload()**
```
function reload(nbrMessagePrecendent) {
  // affiche BDD
  $.get("http://192.168.10.10/messageDB/{{$id}}-{{$id2}}", function (data) {
      const nbrMessageActuel = data.length
      if (nbrMessageActuel > nbrMessagePrecendent) {
          console.log(data[0])
          $('.messageEnDirect').append('<div class="msg" style="text-overflow: ellipsis; word-wrap: break-word;">' +
              '                    <p>' +
              '                        <a href=\"/profile/' + data[0].user_id + '\">' + data[0].pseudo + ' </a>: ' + data[0].content +
              '                    </p>' +
              '                </div>');
          scrollEnBas = document.getElementById('text-msg');
          scrollEnBas.scrollTop = scrollEnBas.scrollHeight;
      }
      setTimeout(reload(nbrMessageActuel));
  }, 'json')
}
```
Dans Web.php

La route `/messageDB/{{$id}}-{{$id2}}` permet de recuperer en **Json** tous les messages des users qui ont l'id : *{{$id}}* et *{{$id2}}*

Une fois tous recuperé. on regarde le nombre de message que l'on a reçue pour comparer s'il est superieur ou non a la requete que l'on à efféctuer avant.

Si oui, on ajoute le nouveaux message.

Puis on relance la requete, en boucle.

Se qui nous donne alors ce dynamisme.

### Comment envoyer les données ?

```
const lien = document.getElementById("monform").action
document.getElementById('button-addon1').addEventListener('click', function (e) {
    e.preventDefault();
    let msg = {'message': document.getElementById('text').value}
    $.ajax({
        url: lien,
        data: msg,
        type: 'POST',
        // Ici quand la requete fonctionne faire une action !
        //success: ,
        dataType: 'json',
    })
    $('#text').val('')
})
$('#text').val('')Z
```

- On stocke le lien d'action du formulaire.
- Annule le comportement de base du formulaire (ce qui nous fait pas recharger la page)
- Recuperer les données du textarea
- En **ajax** on envoie les données du textarea
- On vide le textarea