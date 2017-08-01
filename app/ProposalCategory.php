<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalCategory extends Model
{
    public function proposals() {
        return $this->belongsTo('App\Proposal');
    }
}
