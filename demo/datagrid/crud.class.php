<?php

class CRUD{
  
  /**
   *
   * @var PDO 
   */
  protected $pdo;
  
  
  
  public function __construct($pathToSqlite){
    $this->pdo=new PDO('sqlite:'.$pathToSqlite);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }
  
  
  
  public function find($maxResults,$offset){    
    $sql='SELECT rowid, CODGEO,LIBGEO,REG,DEP FROM commune LIMIT '.$offset.','.$maxResults;    
    return $this->pdo->query($sql)->fetchAll();    
  }
  
  public function findOne($id){    
    $sql='SELECT rowid, CODGEO,LIBGEO,REG,DEP FROM commune WHERE rowid='.$id;
//    echo $sql;
    $stmt=$this->pdo->query($sql);
//    print_r($stmt);
    return $stmt->fetch();    
  }
  
  public function update($data){
    if(count($data)!=5){
      return false;
    } 
    $sql='UPDATE commune SET ';
    foreach($this->getFieldList() as $i=>$field){
      $value=$data[$field];
      if(!$value){
        return false;
      }
      $sql.=($i==0)?' ':', ';
      $sql.=$field.'='.$this->pdo->quote($value);
    }
    $sql.=' WHERE rowid='.$data['rowid'];
    echo $sql;
    return $this->pdo->query($sql);
  }
  
  public function getFieldList($withId=false){
    $a= array('CODGEO','LIBGEO','REG','DEP');
    if($withId){
      $a[]='rowid';
    }
    return $a;
  }
}
