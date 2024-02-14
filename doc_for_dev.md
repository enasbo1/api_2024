fonction de gestion des droits:

>Service_utilisateur->as_access(int privilege_level):bool \
    *   renvoie si l'utilisateur a au moins le status $privilege_level \
    *   si le niveau de privilège exigé est de 0, il revoie true même si il n'y a pas de compte connecté

>Service_utilisateur->is_status(int privilege_level):bool \
    *   renvoie si l'utilisateur a exactement le status $privilege_level \
    *   si le niveau de privilège exigé est de 0, il renvoie true si il n'y a pas de compte connecté


                ====================================================================                


dans le fichier ./shared/form.php

header_verification(array[key=>value]):null|String(message d'erreur)
    *effectue une verifictation de la présence et de la conformité de données dans le 'post' ($_POST) 
et renvoie un message d'erreur(String) dans si ce n'est pas le cas (null si tout va bien)

2\ array $form : un tableau [clef => valeur] contenant comme clefs les nom des elements que l'on veux vérifier et en valeur 
les conditions de certification que l'on veux leur appliquer.

les conditions sont des chaines de charactères
il existe differentes conditions:
'r'     // <=> existe et n'est pas vide
'!int'  // <=> est un entier
'!float'// <=> est un réel
'!url'  // <=> est une url valide
'!email'// <=> est un email valide
':>,x'  // <=> est supérieur à x (remplacez x par le nombre que vous voulez)
':<,x'  // <=> est inférieur à x (remplacez x par le nombre que vous voulez)
':M,x'  // <=> fait au maximum x caractères (remplacez x par le nombre que vous voulez)
':m,x'  // <=> fait au moins x caractères (remplacez x par le nombre que vous voulez)

on peut appliquer plusieurs conditions en les séparant avec un espace
ex:
'!int :<,10' // <=> est un entier inférieur à 10

/!\ attention: la condition 'r' doit impérativement être appelé en première, sinon elle ne servira à rien
exemple:
'r !int'    // <=> est definie et est un entier
'!int'      // <=> est un entier ou n'est pas définit
'!int r'    //appliquera: est un entier ou n'est pas définit
