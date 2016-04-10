<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Category;

use Devio\Eavquent\Value\Data\Integer;
use Devio\Eavquent\Attribute\Attribute;

use App\Eav\Value\Data\Option;
use App\Eav\Attribute\Option as AttributeOption;

class MainSeeder extends Seeder
{
    public function assertEqual($left, $right)
    {
        if ($left != $right) {
            debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            throw new Exception("$left not equal to $right");
        }
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Categories */
            Category::getQuery()->delete();
            $category_accumulators = Category::create(['name' => 'Accumulators']);
            $category_engines = Category::create(['name' => 'Engines']);

        /* Attributes */
            Attribute::getQuery()->delete();
            Option::getQuery()->delete();
            Integer::getQuery()->delete();
            AttributeOption::getQuery()->delete();

            // integer attribute for 'Accumulators' category
            $capacityAttribute = Attribute::create([
                'code'          => 'capacity',
                'label'         => 'Capacity, amper*hours',
                'model'         => Integer::class,
                'entity'        => Product::class,
                'default_value' => null,
                'collection'    => false
            ]);

            // integer attribute for 'Engines' category
            $cylindersCountAttribute = Attribute::create([
                'code'          => 'cylinder_count',
                'label'         => 'Cylinders count',
                'model'         => Integer::class,
                'entity'        => Product::class,
                'default_value' => null,
                'collection'    => false
            ]);

            // select attribute
            $manufacturerAttribute = Attribute::create([
                'code'          => 'manufacturer',
                'label'         => 'Manufacturer',
                'model'         => Option::class,
                'entity'        => Product::class,
                'default_value' => null,
                'collection'    => false
            ]);

            $labels = [
                'Sparko',
                'Bosch',
                'Boge',
            ];
            $manufacturer_options = [];
            foreach($labels as $label) {
                $opt = new AttributeOption(['label' => $label]);
                $opt->attribute_id = $manufacturerAttribute->id;
                $opt->save();
                $manufacturer_options[] = $opt;
            }

            // multiselect attribute
            $carsAttribute = Attribute::create([
                'code'          => 'compatible_cars',
                'label'         => 'Compatible with cars',
                'model'         => Option::class,
                'entity'        => Product::class,
                'default_value' => null,
                'collection'    => true
            ]);

            $labels = [
                'BMW X5',
                'Toyota Corolla',
                'Wolkswagen Passat',
                'Mazda Z5',
                'Nissan Kashkai',
            ];
            $car_options = [];
            foreach($labels as $label) {
                $opt = new AttributeOption(['label' => $label]);
                $opt->attribute_id = $carsAttribute->id;
                $opt->save();
                $car_options[] = $opt;
            }

        /* Products */
            Product::getQuery()->delete();

            $accumulator1 = new Product([
                'category_id'            => $category_accumulators->id,
                'sku'                    => 'accumulator1',
                'name'                   => 'Cool Accumulator 1',
                'price'                  => 101,
                'description'            => 'accumulator1 description',
                'qty'                    => 11,
                $capacityAttribute->code => 1200
            ]);
            $accumulator1->{$manufacturerAttribute->code} = $manufacturer_options[0]->id;
            $accumulator1->{$carsAttribute->code} = [
                $car_options[0]->id,
                $car_options[1]->id
            ];
            $accumulator1->save();
            $this->assertEqual($accumulator1->capacity, 1200);
            $this->assertEqual($accumulator1->manufacturer->label, 'Sparko');
            $this->assertEqual($accumulator1->compatible_cars[0]->label, 'BMW X5');
            $this->assertEqual($accumulator1->compatible_cars[1]->label, 'Toyota Corolla');


            $accumulator2 = new Product([
                'category_id'            => $category_accumulators->id,
                'sku'                    => 'accumulator2',
                'name'                   => 'Cool Accumulator 2',
                'price'                  => 102,
                'description'            => 'accumulator2 description',
                'qty'                    => 12,
                $capacityAttribute->code => 2200
            ]);
            $accumulator2->{$manufacturerAttribute->code} = $manufacturer_options[1]->id;
            $accumulator2->{$carsAttribute->code} = [
                $car_options[1]->id,
                $car_options[2]->id
            ];

            $accumulator2->save();
            $this->assertEqual($accumulator2->capacity, 2200);
            $this->assertEqual($accumulator2->manufacturer->label, 'Bosch');
            $this->assertEqual($accumulator2->compatible_cars[0]->label, 'Toyota Corolla');
            $this->assertEqual($accumulator2->compatible_cars[1]->label, 'Wolkswagen Passat');



            $engine1 = new Product([
                'category_id'                  => $category_engines->id,
                'sku'                          => 'engine1',
                'name'                         => 'Cool Engine 1',
                'price'                        => 201,
                'description'                  => 'engine1 description',
                'qty'                          => 21,
                $cylindersCountAttribute->code => 4
            ]);
            $engine1->{$manufacturerAttribute->code} = $manufacturer_options[0]->id;
            $engine1->{$carsAttribute->code} = [
                $car_options[2]->id,
                $car_options[3]->id
            ];
            $engine1->save();
            $this->assertEqual($engine1->cylinder_count, 4);
            $this->assertEqual($engine1->manufacturer->label, 'Sparko');
            $this->assertEqual($engine1->compatible_cars[0]->label, 'Wolkswagen Passat');
            $this->assertEqual($engine1->compatible_cars[1]->label, 'Mazda Z5');


            $engine2 = new Product([
                'category_id'                  => $category_engines->id,
                'sku'                          => 'engine2',
                'name'                         => 'Cool Engine 2',
                'price'                        => 202,
                'description'                  => 'engine2 description',
                'qty'                          => 22,
                $cylindersCountAttribute->code => 6
            ]);
            $engine2->{$manufacturerAttribute->code} = $manufacturer_options[2]->id;
            $engine2->{$carsAttribute->code} = [
                $car_options[3]->id,
                $car_options[4]->id
            ];

            $engine2->save();
            $this->assertEqual($engine2->cylinder_count, 6);
            $this->assertEqual($engine2->manufacturer->label, 'Boge');
            $this->assertEqual($engine2->compatible_cars[0]->label, 'Mazda Z5');
            $this->assertEqual($engine2->compatible_cars[1]->label, 'Nissan Kashkai');
    }
}
