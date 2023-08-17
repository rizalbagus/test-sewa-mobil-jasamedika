<?php
namespace App\Traits;

use Facades\Str;

trait UuidTrait
{
  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
      $model->keyType = 'string';
      $model->incrementing = false;

      $model->{$model->getKeyName()} = $model->{$model->getKeyName()} ?: (string) Str::orderedUuid();
    });
  }

  public function getIncrementing()
  {
    return false;
  }

  public function getKeyType()
  {
    return 'string';
  }
}