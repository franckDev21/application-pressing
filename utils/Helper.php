<?php 
  namespace Help;

  use App\Models\Commande;

  class Helper{

    public static function getTotalVetement(Commande $commande): int{
      // on recupere tous les vêtements de la commande
      $vetements = $commande->vetements;

      $qte = 0;

      foreach($vetements as $vetement){
        $qte += (int)$vetement->quantite;
      }

      return $qte;
    }


    public static function getColorForCommandeStatut(string $statut): string{
      switch ($statut) {
        case 'IMPAYER':
          return 'text-red-400';
          break;

        case 'AVANCER':
          return 'text-orange-400';
          break;

        default:
          return 'text-green-500';
          break;
      }
    }

  }