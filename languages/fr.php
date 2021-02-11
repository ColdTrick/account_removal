<?php

return array (
  'account_removal' => 'Suppression du compte',
  'account_removal:menu:title' => 'Suppression du compte',
  'account_removal:disable:default' => 'Ce compte a été désactivé à la demande de l\'utilisateur',
  'account_removal:admin:settings:user_options' => 'Sélectionnez les options de suppression de compte',
  'account_removal:admin:settings:user_options:disable' => 'Désactiver',
  'account_removal:admin:settings:user_options:remove' => 'Supprimer',
  'account_removal:admin:settings:user_options:disable_and_remove' => 'Désactivation et suppression',
  'account_removal:admin:settings:groupadmins_allowed' => 'Les administrateurs peuvent désactiver et supprimer leur compte',
  'account_removal:admin:settings:reason_required' => 'Motif de suppression du compte exigé pour l\'utilisateur',
  'account_removal:user:error:admin' => 'Les administrateurs ne sont pas autorisés à désactiver et supprimer leur compte',
  'account_removal:user:error:user' => 'Vous ne pouvez désactiver ou supprimer que votre compte',
  'account_removal:user:error:no_user' => 'Entrée invalide ; Utilisateur non trouvé',
  'account_removal:user:title' => 'Suppression du compte',
  'account_removal:forms:user:user_options:description:disable' => 'Vous pouvez <b>désactiver</b> votre compte ici. Votre profil sera alors désactivé. Cela signifie que les détails de votre profil ne sont plus visibles et que votre compte n\'apparaîtra dans aucune liste d\'utilisateurs.<br><br>Tous vos contenus, comme les blogs, les fichiers et les pages, resteront accessibles aux autres utilisateurs.',
  'account_removal:forms:user:user_options:description:remove' => 'Vous pouvez <b>supprimer</b> votre compte ici. Votre profil sera alors complètement supprimé. Cela signifie que les détails de votre profil ne sont plus visibles et que votre compte n\'apparaîtra dans aucune liste d\'utilisateurs.<br><br> De plus <b>tout</b> votre contenu, comme les blogs, les fichiers et les pages seront supprimés. Cette action ne peut pas être annulée !',
  'account_removal:forms:user:user_options:description:disable_and_remove' => 'Vous pouvez <b>désactiver</b> ou <b>supprimer</b> votre compte ici. Cela désactivera ou supprimera votre profil. Cela signifie que les détails de votre profil ne sont plus visibles et que votre compte n\'apparaîtra dans aucune liste d\'utilisateurs.<br><br>Si vous choisissez de <b>désactiver</b> votre compte, tout votre contenu, comme les blogs, les fichiers et les pages, restera accessible aux autres utilisateurs.<br>Si vous choisissez de <b>supprimer</b> votre compte, tout votre contenu, comme les blogs, les fichiers et les pages, sera supprimé. Cette action ne peut pas être annulée !',
  'account_removal:forms:user:user_options:description:disable_and_remove:choice' => 'Je souhaite',
  'account_removal:forms:user:user_options:description:general' => 'Lorsque vous effectuez la demande de suppression de compte, vous recevez un courrier électronique de confirmation dans votre boite mail. La suppression du compte sera effectuée lorsque vous suivrez les instructions contenues dans ce courrier électronique.',
  'account_removal:forms:user:user_options:disable' => 'Désactiver ce compte',
  'account_removal:forms:user:user_options:remove' => 'Supprimer ce compte',
  'account_removal:forms:user:reason' => 'Veuillez indiquer la raison de cette suppression de compte',
  'account_removal:forms:user:js:confirm:disable' => 'Êtes-vous sûr de vouloir désactiver ce compte ?',
  'account_removal:forms:user:js:confirm:remove' => 'Êtes-vous sûr de vouloir supprimer ce compte ?',
  'account_removal:forms:user:error:group_owner' => 'Vous ne pouvez pas vous désactiver ou supprimer votre compte car vous êtes toujours administrateur des groupes suivants.',
  'account_removal:message:disable:subject' => 'Vous avez demandé la désactivation de votre compte sur %s',
  'account_removal:message:remove:subject' => 'Vous avez demandé à supprimer votre compte sur %s',
  'account_removal:message:disable:body' => '%,
Vous avez demandé que votre compte soit désactivé.
Tout le contenu que vous avez réalisé sur le site restera disponible pour les autres utilisateurs. Cependant, vous ne pouvez plus vous connecter, votre compte n\'apparaîtra pas dans la liste des utilisateurs et votre profil sera inaccessible.

Pour confirmer que vous souhaitez réellement désactiver votre compte, veuillez cliquer sur le lien suivant :
%s

Nous espérons que vous avez apprécié notre réseau et vous remercions pour vos contributions.',
  'account_removal:message:remove:body' => '%,
Vous avez demandé que votre compte soit supprimé.
Tout le contenu que vous avez fait sur le site sera également supprimé

Pour confirmer que vous voulez vraiment supprimer votre compte, veuillez cliquer sur le lien suivant :
%s

Nous espérons que vous avez apprécié notre communauté et vous remercions pour vos contributions.',
  'account_removal:message:thank_you:remove:subject' => 'Merci d\'avoir utilisé %s',
  'account_removal:message:thank_you:disable:subject' => 'Merci d\'avoir utilisé %s',
  'account_removal:message:thank_you:remove:body' => '%,
Nous vous remercions d\'avoir utilisé %. Nous espérons que vous avez apprécié notre réseau.

Si à tout moment vous souhaitez revenir, vous pouvez toujours créer un nouveau compte.

Nous vous remercions encore une fois pour vos contributions.',
  'account_removal:message:thank_you:disable:body' => '%,
Nous vous remercions d\'avoir utilisé %. Nous espérons que vous avez apprécié notre réseau.

Si vous souhaitez revenir, vous pouvez toujours créer un nouveau compte ou demander à l\'administrateur du site de réactiver votre compte.

Nous vous remercions encore une fois pour vos contributions.',
  'account_removal:actions:remove:error:user_guid:admin' => 'Les administrateurs ne sont pas autorisés à désactiver ou supprimer leur compte',
  'account_removal:actions:remove:error:group_owner' => 'Vous ne pouvez actuellement pas désactiver ou supprimer votre compte car vous êtes toujours administrateur des groupes suivants',
  'account_removal:actions:remove:error:reason' => 'Vous devez indiquer un motif',
  'account_removal:actions:remove:error:type_match' => 'Le motif de suppression de compte indiqué dans la demande n\'est pas pris en compte actuellement',
  'account_removal:actions:remove:error:token_mismatch' => 'Le code de confirmation fourni ne correspond pas. Veuillez demander une nouvelle confirmation par e-mail.',
  'account_removal:actions:remove:success:remove' => 'Votre compte a été supprimé avec succès',
  'account_removal:actions:remove:success:disable' => 'Votre compte a été désactivé avec succès',
  'account_removal:actions:remove:success:request' => 'Votre demande de désactivation ou suppression de votre compte a bien été prise en compte. Veuillez vérifier votre boite mail pour la confirmer.',
);
