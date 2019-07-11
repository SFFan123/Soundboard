<?php
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

$englishonly = array(
    'af' => 'Slegs Engels, asseblief. Dankie.', // afrikaans.
    'ar' => 'انجليزي فقط من فضلك. شكرا لكم.', // arabic.
    'bg' => 'Само на английски, моля. Благодаря ти.', // bulgarian.
    'ca' => 'Només en anglès, per favor. Gràcies.', // catalan.
    'cs' => 'Pouze anglicky, prosím. Děkuji.', // czech.
    'da' => 'Kun engelsk, tak. Tak skal du have.', // danish.
    'de' => "Bitte nur English im Chat, Vielen Dank!", // german.
    'el' => 'Αγγλικά μόνο, παρακαλώ. Ευχαριστώ.', // greek.
    'en' => 'English only, please. Thank you.', // english.
    'es' => 'Solo inglés por favor. Gracias.', // spanish.
    'et' => 'Ainult inglise keeles. Aitäh.', // estonian.
    'fi' => 'Vain englanniksi. Kiitos.', // finnish.
    'fr' => 'Anglais seulement s\'il vous plait. Je vous remercie.', // french.
    'gl' => 'Só inglés, por favor. Grazas.', // galician.
    'he' => 'רק אנגלית בבקשה. תודה.', // hebrew.
    'hi' => 'कृपया केवल अंग्रेजी। धन्यवाद।', // hindi.
    'hr' => 'Samo na engleskom, molim. Hvala vam.', // croatian.
    'hu' => 'Csak angolul. Köszönöm.', // hungarian.
    'id' => 'Hanya dalam bahasa Inggris. Terima kasih.', // indonesian.
    'it' => 'Solo inglese, per favore. Grazie.', // italian.
    'ja' => '英語だけでお願いします。ありがとうございました。', // japanese.
    'ko' => '영어로만하십시오. 고맙습니다.', // korean.
    'ka' => 'ინგლისური მხოლოდ, გთხოვთ. Გმადლობთ.', // georgian.
    'lt' => 'Tik anglų kalba. Ačiū.', // lithuanian.
    'lv' => 'Tikai angļu valodā. Paldies.', // latvian.
    'ms' => 'Hanya bahasa Inggeris, sila. Terima kasih.', // malay.
    'nl' => 'Alleen engels alstublieft. Dank je.', // dutch.
    'no' => 'Bare engelsk, vær så snill. Takk skal du ha.', // norwegian.
    'pl' => 'Proszę tylko po angielsku. Dziękuję Ci.', // polish.
    'pt' => 'Somente inglês por favor. Obrigado.', // portuguese.
    'ro' => 'Doar engleza va rog. Mulțumesc.', // romanian.
    'ru' => 'Только на английском, пожалуйста. Спасибо.', // russian.
    'sk' => 'Len anglicky, prosím. Ďakujem.', // slovak.
    'sl' => 'Samo v angleščini, prosim. Hvala vam.', // slovenian.
    'sq' => 'Anglisht vetëm, ju lutem. Faleminderit.', // albanian.
    'sr' => 'Само на енглеском, молим. Хвала вам.', // serbian.
    'sv' => 'Bara engelska tack. Tack.', // swedish.
    'th' => 'ได้โปรดใช้ภาษาอังกฤษเท่านั้น ขอบคุณ.', // thai.
    'tr' => 'Sadece ingilizce lütfen. Teşekkür ederim.', // turkish.
    'uk' => 'Лише англійською. Дякую.', // ukrainian.
    'zh' => '请给我英文。谢谢。' // chinese.
);

echo $englishonly[$lang];
?>