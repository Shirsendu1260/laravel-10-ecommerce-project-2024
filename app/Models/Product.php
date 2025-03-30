<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function get_product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function setShippingReturnsAttribute($value)
    {
        $default = "<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>";

        // If the user does not provide 'shipping_returns' column value, then set the column value to the default text
        $this->attributes["shipping_returns"] = ($value !== null) ? $value : $default;
    }

    public function get_product_ratings()
    {
        return $this->hasMany(ProductRating::class)->where('product_ratings.status', '1');
    }
}
