<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FieldOptionType;
use App\Models\FieldOption;
use DateTime;

class FieldOptionSeeder extends Seeder
{
    public function run()
    {
        $fieldOptionsArray["Calendar Hour Format:calendar_hour_format"] = "Format:yyyy-mm-dd ,mm-dd-yyyy ,dd-mm-yyyy";
        $fieldOptionsArray["Product Type:product_type"] = "Product Type:Product ,Service";

        $id = 0;

        foreach ($fieldOptionsArray as $fieldOptionKey => $fieldOptionsValue) {

            list($comment, $description, $payload) = explode(":", $fieldOptionKey. ":");
            $fieldOptionType = new FieldOptionType();
            $fieldOptionType->type_description = trim($description);
            $fieldOptionType->comment = $comment;
            $fieldOptionType->payload = str_replace(["=>", "'"], [":", '"'], $payload); // Replace => with : and Single Qoute ' with Double Qoute "
            if ($fieldOptionType->save()) {
                list($typeDescription, $types) = explode(":", $fieldOptionsValue);
                $fieldOption = new FieldOption();
                $typesArray = [];
                foreach (explode(",", $types) as $value) {
                    $id++;
                    $typesArray[] = [
                        "id" => $id,
                        "type_id" => $fieldOptionType->id,
                        "name" => trim($value),
                        "short_name" => "",
                        "description" => $typeDescription,
                        "created_at" => new DateTime(),
                        "updated_at" => new DateTime()
                    ];
                }
                $fieldOption->insert($typesArray);
            }
        }
    }
}
