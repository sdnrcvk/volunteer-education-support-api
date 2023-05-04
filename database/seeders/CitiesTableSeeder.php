<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement(query: "INSERT INTO cities(city_name) VALUES('ADANA'),('ADIYAMAN'),('AFYON'),('AĞRI'),('AMASYA'),('ANKARA'),('ANTALYA'),('ARTVİN'),('AYDIN'),
        ('BALIKESİR'),('BİLECİK'),('BİNGÖL'),('BİTLİS'),('BOLU'),('BURDUR'),('BURSA'),('ÇANAKKALE'),('ÇANKIRI'),('ÇORUM'),('DENİZLİ'),('DİYARBAKIR'),('EDİRNE'),
        ('ELAZIĞ'),('ERZİNCAN'),('ERZURUM'),('ESKİŞEHİR'),('GAZİANTEP'),('GİRESUN'),('GÜMÜŞHANE'),('HAKKARİ'),('HATAY'),('ISPARTA'),('İÇEL'),('İSTANBUL'),
        ('İZMİR'),('KARS'),('KASTAMONU'),('KAYSERİ'),('KIRKLARELİ'),('KIRŞEHİR'),('KOCAELİ'),('KONYA'),('KÜTAHYA'),('MALATYA'),('MANİSA'),
        ('KAHRAMANMARAŞ'),('MARDİN'),('MUĞLA'),('MUŞ'),('NEVŞEHİR'),('NİĞDE'),('ORDU'),('RİZE'),('SAKARYA'),('SAMSUN'),('SİİRT'),('SİNOP'),('SİVAS'),
        ('TEKİRDAĞ'),('TOKAT'),('TRABZON'),('TUNCELİ'),('ŞANLIURFA'),('UŞAK'),('VAN'),('YOZGAT'),('ZONGULDAK'),('AKSARAY'),('BAYBURT'),('KARAMAN'),
        ('KIRIKKALE'),('BATMAN'),('ŞIRNAK'),('BARTIN'),('ARDAHAN'),('IĞDIR'),('YALOVA'),('KARABÜK'),('KİLİS'),('OSMANİYE'),('DÜZCE')");
    }
}
