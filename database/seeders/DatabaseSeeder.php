<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $faker;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $nombres = ['Ropa', 'Electrodomésticos', 'Consolas', 'Juguetes'];

        foreach ($nombres as $nombre) {
            Category::factory()->create(['name' => $nombre]);
        }

        $screen = Product::factory()->screen()->create();
        $shoes = Product::factory()->shoes()->create();
        $console = Product::factory()->console()->create();
        $toy = Product::factory()->toy()->create();

        $amazon = Shop::factory()->amazon()->create();
        $backmarket = Shop::factory()->backmarket()->create();
        $pccomponentes = Shop::factory()->pccomponentes()->create();
        $jdsports = Shop::factory()->jdsports()->create();
        $footlocker = Shop::factory()->footlocker()->create();
        $ebay = Shop::factory()->ebay()->create();

        User::factory()->admin()->create();
        User::factory()->provider()->create();
        User::factory()->user()->create();

        /*foreach (Shop::all() as $shop) {
            $products = Product::inRandomOrder()->limit(3)->pluck('id')->toArray();
            foreach ($products as $product) {
                $shop->product()->attach($product, [
                    'rating' => rand(1, 5),
                    'price' => fake() -> randomFloat(2, 1, 500),
                    'product_link' => fake()->url,
                ]);
            }
        }*/

        $ebay->product()->attach($screen->id, [
            'rating' => 4,
            'price' => 50.92,
            'product_link' => 'https://www.ebay.es/itm/204406706872?chn=ps',
        ]);

        $backmarket->product()->attach($screen->id, [
            'rating' => 5,
            'price' => 90.00,
            'product_link' => 'https://www.backmarket.es/es-es/p/monitor-22-led-samsung-syncmaster-s22a450bw-grade-a/f1d7d88a-658c-4ae4-9eac-3a40c4522df2?shopping=gmc&gclid=&msclkid=6f8bf996802d1121c0e691dae89ee364&utm_source=bing&utm_medium=cpc&utm_campaign=ES_SA_SHOP_M_GEN_Other_RSC&utm_term=4582901948803290&utm_content=Others&l=12',
        ]);

        $footlocker->product()->attach($shoes->id, [
            'rating' => 4,
            'price' => 169.99,
            'product_link' => 'https://www.footlocker.es/es/product/~/314109178104.html?channable=041dd0696400333134313039313738313034313130e9&msclkid=00acb2d250c913418350da9e3acc9a89&utm_source=bing&utm_medium=cpc&utm_campaign=_1%3Aes_2%3Aperformance_3%3Abing_4%3Ado_5%3Asmart-shopping_6%3Aconversion_7%3Amix_8%3Aalways%20on_9%3Amultiple_10%3Ana_16%3Ana&utm_term=2322855753277167&utm_content=all%20products',
        ]);

        $jdsports->product()->attach($shoes->id, [
            'rating' => 3,
            'price' => 170.00,
            'product_link' => 'https://www.jdsports.es/product/blanco-jordan-jumpman-mvp/19683642_jdsportses/?utm_source=Google&utm_medium=cpc&utm_campaign=Shopping&istCompanyId=fc697438-ec98-4174-937f-46311e2edbcd&istFeedId=dce4e993-ab38-47d7-98d9-7b3e313629ea&istItemId=qrimpwmwr&istBid=t&utm_source=google&utm_medium=cpc&utm_campaign=es_performance_max_nike&gad_source=1&gad_campaignid=20162046169&gbraid=0AAAAAqnhh_pq59876RjbEmimxQf2FcUHQ&gclid=Cj0KCQjwmK_CBhCEARIsAMKwcD4PEt0jcuR_AKVW31rUnhin6FC7yloSxEZfrDO3duAzQvdF4idODBgaAvRhEALw_wcB',
        ]);

        $pccomponentes->product()->attach($console->id, [
            'rating' => 5,
            'price' => 299.00,
            'product_link' => 'https://www.pccomponentes.com/microsoft-xbox-series-s-512gb-blanca?s_kwcid=AL!14405!3!201300342362!!!g!2304306012627!&gad_source=1&gad_campaignid=861617448&gclid=Cj0KCQjwmK_CBhCEARIsAMKwcD7H84r2t53JjXFDu8w9HZuRBwEhMuThP_LnTLjBWhlohVm-B_fCEzkaAg3EEALw_wcB',
        ]);

        $backmarket->product()->attach($console->id, [
            'rating' => 4,
            'price' => 250.00,
            'product_link' => 'https://www.backmarket.es/es-es/p/xbox-series-s-500gb-blanco/0380bf8d-b165-4c0f-be29-1af05304ee37?shopping=gmc&utm_source=google&utm_medium=cpc&utm_campaign=ES_SA_SHOP_G_GEN_Consoles_RSC_TOP_PERFORMERS&gclid=Cj0KCQjwmK_CBhCEARIsAMKwcD6KG-Qc0ccmbjm45L_GXKKBjjMt4XU7PKHtGPibQ6sXlxjBLvTKUzgaAv30EALw_wcB&gad_source=1&gad_campaignid=22181244433&gbraid=0AAAAADDppdBRXXP2EGEDElH51Fimv5Kk5&l=11',
        ]);

        $amazon->product()->attach($toy->id, [
            'rating' => 5,
            'price' => 11.99,
            'product_link' => 'https://www.amazon.es/Nerf-personalizaci%C3%B3n-incorporadas-Individual-Multicolor/dp/B07ZYCNZTZ/ref=asc_df_B07ZYCNZTZ/?tag=googshopes-21&linkCode=df0&hvadid=699847476647&hvpos=&hvnetw=g&hvrand=15934064034602359668&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1005493&hvtargid=pla-938566146705&mcid=52037af25c9c30868f679ffd33da72cc&hvocijid=15934064034602359668-B07ZYCNZTZ-&hvexpln=0&th=1',
        ]);
    }
}
