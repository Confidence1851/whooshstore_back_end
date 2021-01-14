<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array("Health & Beauty", "Home & Office", "Phones & Tablets","Computing","Electronics","Fashion","Baby Products","Gaming");
        $myarray = array( 
            array("Hand Sanitizer", "Lotion", "Face Mask","Vaseline","Beard Oil","Vitamins C","Imperial Leather Soap","Teeth Whitener","Perfume Oil","Avila Black Soap"), 
            array("Binatone", "Century Kettle", "Bed Sheets","Adjustable folding laptop Stand","Hangers","Industrial Waste Bin","Shoe Rack","Projector Ceiling Mount","Mini Handy Bill Cash Banknote Counter","Rats Metal Trap","Tooth Paste Dispenser"), 
            array("Samsung Galaxy A3", "Samsung Galaxy S10", "Araimo COmpact 10000MAH Power Bank","Huwaei Land Line","Iphone 12 Pro","Samsung Galaxy A51","Smart Watch T55 Bluetooth","Imose LandLine Mount","Oppo A93","Xiaomi Redmi Note 9","Samsung M11"),
            array("Asus zenPad", "Asus Mini Intel celeron Laptop","Sans Disk 32Gb Flash Drive", "File King 32GB USB OTG Flash Drive","Hp DeskJet Wireless Printer 2620","Xprinter Mobile Printer","Hp ProLiant ML30 G10 E-2124","Airtel 4G Lte Mifi","Dell 20 Monitor E2016HV","2,4G Wireless Mouse Portable Ultra Thin Mute Mouse","Samsung 64Gb Pen Drive","Hp FLexible USB External Keyboard"), 
            array("Bluetooth Headset", "F9 Wireless HeadPhones", "Waterproof Bluetooth Headset","Smart Watch Two Series","Apple Airpod 2","Finger Print Bluetooth Pods","2 in 1 USB Wireless Bluetooth 5.0 Audio Transmitter","Mad Beat Ceiling Mount","Tripod for Mobile Phone","Mini Earphones Blueetooth Wireless","Kinelco Steam And Spray Iron"),
            array("Ladies Women Gorgrous Top", "6 in 1 ROund neck t-shirt", "100% Cotton 12 pieces of Mens Boxer","Chelsea TrackSuit Pants Kit","Cute Ladies Bag","Men Leather wallet","Smart Unisex Sandals Rack","Safety Sneakers","Double LED Digital Watch","Plain Mens T-Shirt","Mens Belt Brown"), 
            array("6 pairs Baby Booties", "Newborn Infant Baby Stroller", "Baby Bed Sheets","Molfix Pant Size 5","Baby Feeding Bottle Warmer","Cussons Baby Wipes","Baby Blankets","Chicco DIapers","Mothers Choice 5pcs Newborn Bodysuits","Huggies Nappy Pants","Baby Tooth Paste Formula"), 
            array("Sony Play Station 4", "EA Sports Fifa", "Ps4 Call of Duty","Logitech G29 Driving Force Racing","Sony PS4 1TB Slim Console","Siny PS4 Controller Pad","Xbox One S 1TB Console","Xbox One Gaming Controller","EA Sports FIFA 21","Sony God Of War PS4","Wireless GamePad X3") 
        );
        $colors = array("Neutral","Red","Blue","Yellow","Orange","Black");
        $sizes = array("XXS","XS","S","M","L","XL","XXL");
        $products = array();
        $count = 0;
            foreach ($myarray as $nested) {
                $count++;
                foreach ($nested as $value) {
                    $pro = array(
                        'product_name' => $value,
                        'slug' => $value,
                        'category_id' => $count,
                        'user_id' => rand(3, 50),
                        'sku' => $value.rand(3, 50),
                        'quantity' => rand(1, 50),
                        'price' => round(rand(1000, 50000), -3),
                        'video' => 'file',
                        'description' => $value.' '.$value,
                        'details' => '30 inch price',
                        'tags' => 'tv',
                        'percent_off' => '10',
                        'weight' => '5',
                        'color' => $colors[array_rand($colors, 1)],
                        'size' => $sizes[array_rand($sizes, 1)],
                        'type' => 'featured',
                        'status' => 'active',
                    );
                    array_push($products,$pro);
                }
            }

        foreach ($products as $key => $value) {
            Product::create($value);
        }
        /*
            Product::factory()
            ->times(5)
            ->create();
        */
    }
}
