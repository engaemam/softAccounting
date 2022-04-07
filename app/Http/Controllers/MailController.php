<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Model\Clients;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   
   public function html_email($id) {
  
      
        $client_email = Clients::where('id',$id)->value('email');
        $data = array('name'=>"Support",'email' => $client_email);

        

        Mail::send('mail', $data, function($message) use($client_email) {
         $message->to($client_email,'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('perfectdemo2020@gmail.com','Virat Gandhi');
         });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('ahmad@brandingbar.de', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
        //  $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
        //  $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('eng.aemam94@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}