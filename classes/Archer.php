<?php

class Archer extends Character
{
  public $weakPoint = false;
  public $doubleBow = false;
  private $quiver = 5;

  public function __construct($name) {
      $this->name = $name;
      $this->damage = 5;
  }

//fonction de tour//
  public function turn($target) {
    $rand = rand(1, 10);
    if ($this->quiver == 0) {
        $status = $this->attack($target);
    } else if($rand < 5)  {
        $status = $this->bow($target);
    } else if ($rand = 6 || 7) {
        $status = $this->doubleBow();
    } else if ($rand > 8) {
        $status = $this->weakPoint();
    }
    return $status;
  }

//fonction de l'arc //
  public function bow($target){
    $bowDamage = rand(10,20);
    $this->quiver -= 1;
    $target->setHealthPoints($bowDamage);
    $status ="$this->name attaque avec son arc $target->name à qui il reste $target->healthPoints, il lui reste $this->quiver flèches !";
    if($this->quiver == 1){
      $status ="$this->name attaque avec son arc $target->name à qui il reste $target->healthPoints, il ne lui reste plus que $this->quiver flèche !!";
      return $status;
    }

//si l'on tombe sur point faible//
  if($this->weakPoint = true){
    $weakPointDamage = $bowDamage * rand(1.5,3);// /10; //
    $target->setHealthPoints($weakPointDamage);
    $status = "$this->name inflige de lourds dégâts grâce à weakPoint, il reste $target->healthPoints à $target->name et $this->quiver flèches !";
      if(!$this->weakPoint= true){
      $this->weakPoint = false;
    }
      return $status;
  }

//si l'on tombe sur double fèches//
  if($this->doubleBow = true){
    $doubleBowDamage = $bowDamage * 2;
    $target->setHealthPoints($doubleBowDamage);
    $this->quiver -= 1;
    $status = "$this->name attaque deux fois avec son arc grâce à doubleBow, il reste $target->healthPoints à $target->name et $this->quiver flèches !";
      if(!$this->doubleBow = true){
      $this->doubleBow = false;
    }
      return $status;
  }
}

//fonction point faible//
  public function weakPoint(){
    $this->weakPoint = true;
    $status = "$this->name lance weakPoint et augmente ses dégâts au prochain tour !";
    return $status;
  }

//fonction double flèches//
  public function doubleBow(){
    $this->doubleBow = true;
    $status = "$this->name lance doubleBow et se prépare à attaquer deux fois au prochain tour !";
    return $status;
  }

//fonction attack de base//
  public function attack($target){
    $target->setHealthPoints($this->damage);
    $status = "$this->name n'a plus de flèches et donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
    return $status;
  }
}
