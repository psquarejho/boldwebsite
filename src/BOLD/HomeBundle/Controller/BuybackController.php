<?php

namespace BOLD\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BuybackController extends Controller
{
  function indexAction(Request $request)
  {
     $posttext = $request->request->get('raw_textarea');
     #print_r($posttext);
     $contractvalue = null;
     if($posttext)
     {
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, "http://evepraisal.com/estimate");
       curl_setopt($ch, CURLOPT_POST, 1);
       $fields = array(
         "hide_buttons"  => "false",
         "market" => 30000142,
         "paste_autosubmit" => false,
         "raw_paste"  => $posttext,
         "save" => "false",
       );
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
       $returntext = curl_exec($ch);
     #  print_r($posttext);
       curl_close($ch);
       $matches = array();
       $returntext = str_replace("\n","",$returntext);
       $returntext = str_replace("\r","",$returntext);
       if(preg_match("/Total Sell Value(.+)/", $returntext, $matches))
       {
         $valuetext = $matches[1];
         $matches2 = array();
         # 4. match is the estimated sell value in jita
         if(preg_match_all('/<span class="nowrap">([^<]+)<\/span>/', $valuetext, $matches2))
         {
           $contractvalue = str_replace(",","",$matches2[1][3])*0.85;
         }
       }
     }

     return $this->render('BOLDHomeBundle:Buyback:index.html.twig', array( "controller" => "buyback", "textarea" => $posttext, "contractvalue"  => $contractvalue ));
  }
}
