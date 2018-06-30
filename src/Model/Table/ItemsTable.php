<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ItemsTable extends Table
{
  public function validationDefault(Validator $validator)
    {
        $validator->add('item', 'not-blank', ['rule' => 'notBlank', 'message' => 'Please specify items']);
      $validator->add('amount', 'not-blank', ['rule' => 'notBlank', 'message' => 'Please specify items']);
      $validator->add('name', 'not-blank', ['rule' => 'notBlank', 'message' => 'Please specify items']);

      return $validator;
    }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
     public function buildRules(RulesChecker $rules)
 {
     // Add validation rules
     $rules->add(function($entity) {
         $data = $entity->extract($this->schema()->columns(), true);
         $validator = $this->validator('default');
         $errors = $validator->errors($data, $entity->isNew());
         $entity->errors($errors);

         return empty($errors);
     });

     return $rules;
 }

}

?>
