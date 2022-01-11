<?php

namespace feed\classes;

class CreateJSON 
{
    const ADDR = "https://en.surebet.com/valuebets?utf8=%E2%9C%93&filter%5Bselected%5D%5B%5D=&filter%5Bselected%5D%5B%5D=33792509&filter%5Bsave%5D=&filter%5Bcurrent_id%5D=33792509&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.4&selector%5Bmax_odds%5D=10.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A66%3A%3A%3B0%3A72%3A%3A%3B0%3A71%3A%3A%3B0%3A144%3A%3A%3B0%3A69%3A%3A%3B0%3A110%3A%3A%3B0%3A128%3A%3A%3B0%3A122%3A%3A%3B0%3A21%3A%3A%3B0%3A23%3A%3A%3B0%3A26%3A%3A%3B0%3A135%3A%3A%3B0%3A146%3A%3A%3B0%3A121%3A%3A%3B0%3A%3A%3A%3B0%3A32%3A%3A%3B0%3A161%3A%3A%3B0%3A100%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A142%3A%3A%3B0%3A113%3A%3A%3B0%3A131%3A%3A%3B0%3A24%3A%3A%3B0%3A83%3A%3A%3B0%3A70%3A%3A%3B0%3A125%3A%3A%3B0%3A141%3A%3A%3B0%3A132%3A%3A%3B0%3A104%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A124%3A%3A%3B0%3A154%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A41%3A%3A%3B0%3A126%3A%3A%3B0%3A129%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A114%3A%3A%3B0%3A84%3A%3A%3B0%3A120%3A%3A%3B0%3A162%3A%3A%3B0%3A164%3A%3A%3B0%3A39%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A2%3A%3A%3B0%3A149%3A%3A%3B0%3A139%3A%3A%3B4%3A7%3A%3A%3B0%3A106%3A%3A%3B0%3A140%3A%3A%3B0%3A119%3A%3A%3B4%3A25%3A%3A%3B0%3A136%3A%3A%3B0%3A115%3A%3A%3B0%3A163%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A59%3A%3A%3B0%3A81%3A%3A%3B0%3A116%3A%3A%3B0%3A145%3A%3A%3B0%3A123%3A%3A%3B0%3A87%3A%3A%3B0%3A17%3A%3A%3B0%3A105%3A%3A%3B0%3A53%3A%3A%3B0%3A150%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+43+32+1+2+3+4+55+7+6+5+28+8+44+9+26+34+10+11+12+39+47+46+48+49+59+14+27+53+54+58+16+30+13+17+18+52+29+45+19+36+33+31+40+42+41+20+50+51+21+37+23+22+35+24+38+25&narrow=";
    //Function return children list of 'tr' tags of table
    public function scrapeInit()
    {
        $addr = self::ADDR;
        $scraper = new ScraperInit("$addr");
        return $scraper->scrapeInit();
    }

    //Function create and return values of each game in JSON format
    public function returnJSON()
    {
        $tr_children_list = $this->scrapeInit();
        $iter = 0;
        $json_array = array();
        foreach ($tr_children_list as $game) {
            $iter++;
            array_push($json_array, $this->getValues($game, $iter));
        }
        return json_encode($json_array);
    }

    //Function return array of values from each game
    public function getValues($game, $iter)
    {
        $var = explode(" ", $game->item(0)->nodeValue);
        $bookie = $var[0];
        $sport = $var[1];
        if ($sport == "Dota" || $sport == "League of Legends" || $sport == "Counter-Strike"
            || $sport == "Valorant" || $sport == "Rainbow")
            $sport = "Esport";
        $date_time = $game->item(2)->nodeValue;
        $var = explode("[", $game->item(4)->nodeValue);
        $teams = $var[0];
        $bet = $game->item(6)->nodeValue;
        $odd = floatval($game->item(8)->nodeValue);
        $value = $game->item(14)->nodeValue;
        $value = rtrim($value, "%");
        $value = ltrim($value, "+");
        $value = floatval($value);

        $array = array ($iter, $bookie, $sport, $date_time, $teams, $bet, $odd, $value);
        return $array;
    }

}