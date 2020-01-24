#Doc sur les fonctionalités

## Tchat en direct

### Comment ça fonctionne ?
Le tchat en direct se fait en js grâce à Ajax.  
Voici le code JS pour les messages privés.
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

#### Comment récuperer les données ?

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

#### Comment envoyer les données ?

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

-> Pour les messages dans les canaux c'est le même script sauf qu'il faut adapter les liens et routes. 

## La gestion des rôles.

Pour ajouter ou supprimer des rôles, cela se passe dans: /database/seeds/RolesTableSeeder.php.

Il suffit d'ajouter la ligne `Role::create(['name' => 'nomDuNouveauxRole']);` pour créer un nouveau rôle. 
Ou de supprimer une ligne pour supprimer un rôle.

La gestion se fait ensuite dans les controller ou les view.blade ou les middlewares (ne pas oublier de rajouter le middleware dans Kernel.php).
Il suffit d'autoriser ou non certaines fonctionalités grâce à ces fonction retournant un booléen:  
* `Auth::guest()` -> retourne true si l'utilisateur est déconnecté. Sinon false.
* `Auth::user()->hasRole('nomDuRole')`-> retourne true si l'utilisateur possède ce rôle. Sinon false.

## Les méthodes get et post en général.

Chaque view.blade possède une route dans web.php. Ces routes sont lié à des controller dans /app/http/controller.
Cela permet de lancer des fonctions via des méthodes get ou post et de retourner des valeurs récupérable dans le view.blade concerné.
