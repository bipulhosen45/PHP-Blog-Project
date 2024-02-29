<?php


trait Notify
{
    public function successNotify($msg)
    {
        return '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success !</strong> '.$msg.'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    public function errorNotify($msg)
    {
        return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error !</strong> '.$msg.'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
}