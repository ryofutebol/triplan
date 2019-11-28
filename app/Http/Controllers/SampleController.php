<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;

class SampleController extends Controller
{
  public function SampleMail()
  {
    $name = 'ララベル太郎';
    $text = 'これからもよろしくお願いいたします。';
    $to = 'ryofutebol@gmail.com';
    Mail::to($to)->send(new SampleMail($name, $text));
  }
}
