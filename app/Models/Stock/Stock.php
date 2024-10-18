<?php


namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Misc\Product;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';
    public $incrementing = false;

    protected $fillable = [
        'id_product',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public static function update_stock(int $id_product, int $quantity_to_add, string $operation)
    {
        $operator = $operation === 'add' ? '+' : '-';
        DB::table('stocks')
            ->where('id_product', $id_product)
            ->update(['quantity' => DB::raw('quantity ' . $operator . ' ' . $quantity_to_add)]);
    }

    public static function purchase(int $id_product, int $quantity_to_add)
    {
        self::update_stock($id_product, $quantity_to_add, 'add');
    }

    public static function sale(int $id_product, int $quantity_to_add)
    {
        self::update_stock($id_product, $quantity_to_add, 'subtract');
    }
}