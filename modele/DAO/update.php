<?php

/**
 * Noter
 */
class updateNoteDAO
{

  public static function updateNote($ntR, $ntQ, $ntT, $ntC, $command, $commentaire)
  {
    $sql = 'UPDATE evaluer SET NOTERAPIDITE = ' . $ntR . ', NOTEQUALITE = ' . $ntQ .
          ', NOTETEMP = ' . $ntT . ', NOTECOUT = ' . $ntC . ',    COMMENTAIRE = "' . $commentaire .
          '", COMVISIBLE = 2 WHERE IDC = "' . $command . '"';
  return DBConnex::getInstance()->exec($sql);
  }
}


 ?>
