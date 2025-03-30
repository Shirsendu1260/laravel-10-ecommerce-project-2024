<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $shipping_returns_default = "<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>";

            $table->text("short_desc")->nullable()->after("description");
            $table->longText("shipping_returns")->default($shipping_returns_default)->after("short_desc");
            $table->text("related_products")->nullable()->after("shipping_returns");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('short_desc');
            $table->dropColumn('shipping_returns');
            $table->dropColumn('related_products');
        });
    }
};
