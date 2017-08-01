<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    public function category() {
        return $this->hasOne('App\ProposalCategory');
    }
}
