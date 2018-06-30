<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
{

  public function validationDefault(Validator $validator)
    {
      $validator->add('comment', 'not-blank', ['rule' => 'notBlank', 'message' => 'You must have a title']);
      $validator->add('comment', 'length', [
              'rule' => ['maxLength', 250],
              'message' => 'Comment must be less than 250 characters.'
          ]);
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
