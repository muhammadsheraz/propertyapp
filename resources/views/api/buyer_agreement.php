<html lang="tr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8">
    </head>
    <body style="width:550px;">
<p style="font-family: Arial">
    <img src="<?php echo \Storage::url('images/logo.png'); ?>">
    <br>
    <p style="color: black; font-weight: bold; "><?php echo $broker->company_name; ?></p>
    <p style="color: black; font-weight: bold; "><?php echo $broker->full_name; ?></p>
    <p style="color: black; font-weight: bold; "><?php echo get_address($broker); ?></p>
    <p style="color: black; font-weight: bold; "><?php echo $broker->phone_no; ?></p>
    <p style="color: black; font-weight: bold; "><?php echo $broker->tax_no; ?></p>
    <p style="color: black; font-weight: bold; "><?php echo datestrftime('%d %b, %Y %H:%M', strtotime(date('Y-m-d H:iS'))); ?></p>
    <br>
    <br>
    <h2 style="text-align: center;">Gayrimenkul Alım-Satım Ve Komisyon Sözleşmesi</h2>
    <p style="font-weight: bold;">SATILACAK GAYRİMEKULÜN</p>
    <p style=" white-space: pre;">CİNSİ         : <span style="color: black;"><?php echo $property->title_tr; ?></span></p>
    <?php
        switch ($property->property_purpose) {
            case config('app.rent'):
                $property_purpose =  __('strings.frontend.rent');
                break;
            case config('app.buy'):
                $property_purpose =  __('strings.frontend.sale');
                break;

            default:
                echo "-";
                break;
        }
        ?>
    <p style=" white-space: pre;">Emlak Amaçlı         : <span style="color: black;"><?php echo $property_purpose; ?></span></p>
    <p style=" white-space: pre;">ADRESİ      :  <span style="color: black;"><?php echo get_address($property); ?></span></p>
    <p style=" white-space: pre;">TAPU BİLGİLERİ   :                               ADA: <?php echo $property->ada_no; ?>&nbsp;&nbsp;&nbsp;PAFTA: <?php echo $property->pafta_no; ?>&nbsp;&nbsp;&nbsp;PARSEL: <?php echo $property->parcel_no; ?></p>
    <br>
    <p style=" font-weight: bold;">ALICININ VEYA VEKİLİNİN</span></p>
    <p>SATILACAK GAYRİMEKULÜN</p>
    <br>
    <p>ADI-SOYADI: <span style="color:black;"><?php echo $buyer->full_name; ?></span></p>
    <p>EV ADRESİ: <span style="color:black;"><?php echo get_address($buyer); ?></span></p>
    <p>TELEFON NO: <span style="color:black;"><?php echo $buyer->phone_no; ?></span></p>
    <p>CEP TELEFON NO: <span style="color:black;"><?php echo $buyer->mobile_no; ?></span></p>
    <ul style="list-style-type: decimal;">
        <li>
            <p>Yukarıda adres tapu kayıtları bulunan gayrimenkulü <span style="color:black;">(<?php echo get_currency_symbol($property->currency); ?>) <?php echo number_format($property->price); ?></span> bedelle satıcı satmayı,
             alıcı almayı ve gayrimenkulü alım 
            satımda Emlak Komisyoncusunun aracılık hizmetini tamamladığını kabul etmişlerdir.
            </p>
        </li>
        <li>
            <p style="white-space:pre;">Alıcıdan bu satışa mahsuben                        satıcıya peşinat olarak ödenmiştir. Geriye kalan bedel.7. maddedeki şartlarda açıklandığı gibi ödenecektir.
            </p>
        </li>
        <li>
            <p>A- İşbu akdin imzasından sonra alıcı gayrimenkulü almaktan vazgeçerse anlaşma anında satışa mahsuben verdiği bedeli geri almayacaktır.
            </p>
            <p>B- Satıcı vazgeçerse satışa mahsuben aldığı bedelin iki katını alıcıya vermeyi kabul ve taahhüt eder.</p>
        </li>
        <?php 
            if($property->property_purpose == 'rent'){ 
                $commission = $commission_rent_text;
            } else {
                $commission = $property->commission_value . '%'; 
            }
        ?>         
        <li>
            <p>ve alıcından % <span style="color:black;"><?php echo $commission; ?> </span>olmak üzere işbu akdin imzasından itibaren Emlak Komisyoncusuna, tabuda ferağ anında komisyon ücreti olarak ödemeyi taraflar kabul ve taahhüt etmiştir. 
            </p>
        </li>
        <li>
            <p>İşbu akdin imzasından sonra gayrimenkulu satıcı satmaktan vazgeçerse veya alıcı almaktan vazgeçerse cayan taraf hem kendi ödeyeceği ve hem de diğer tarafın ödeyeceği komisyon ücretinin tamamını Emlak Komisyoncusuna ödemeyi kabul ve taahhüt eder. 
            </p>
        </li>
        <li>
            <p>İşbu akit satıcı, alıcı ve emlak komisyoncusu arasında yukarıda belirtilen ve aşağıdaki özel şartlarla birlikte geçerli olmak üzere imzalanmış olup, doğabilecek uyuşmazlıklarda Ankara Mahkemeleri ve İcra Dairelerinin yetkili olduğu kabul edilmiştir.</p>
        </li>
        <li>
        <p>
        Özel Şartlar............................................................................................................................................................<br>
        ..........................................................................................................................................................................
        </p>
    </ul>
    <span style="white-space: pre; font-weight: bold;"><p>           ALICI                                   SATICI                                         FİRMA ODA SİCİL NO:
                                                                                                                EMLAK KOMİSYONCUSU/TEMSİLEN
                                                                                                                KAŞE İMZA</p></span>
</body>
</html>