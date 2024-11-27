<?php

/**
 * QuotationRequestLines.
 *
 * PHP version 7.3
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */

/**
 * freee請求書 API.
 *
 * <p>freee請求書のAPI仕様です。</p>  <b>freee請求書APIを利用するには、freee請求書への登録が必要です。  登録は<a href=\"https://www.freee.co.jp/invoice/\" target=\"_blank\">freee請求書</a>より行ってください。</b>  </br>  <h3 id=\"about_authorize\">認証について</h3>  <p>OAuth2.0を利用します。<a href=\"https://developer.freee.co.jp/reference/#%e8%aa%8d%e8%a8%bc\" target=\"_blank\">詳細はリファレンスの認証に関する記載を参照してください。</a></p>  <h3 id=\"api_endpoint\">エンドポイント</h3>  <p>https://api.freee.co.jp/iv</p>   <h3 id=\"compatibility\">後方互換性ありの変更</h3>  <p>freeeでは、APIを改善していくために以下のような変更は後方互換性ありとして通知なく変更を入れることがあります。アプリケーション実装者は以下を踏まえて開発を行ってください。</p>  <ul> <li>新しいAPIリソース・エンドポイントの追加</li> <li>既存のAPIに対して必須ではない新しいリクエストパラメータの追加</li> <li>既存のAPIレスポンスに対する新しいプロパティの追加</li> <li>既存のAPIレスポンスに対するプロパティの順番の入れ変え</li> <li>keyとなっているidやcodeの長さの変更（長くする）</li> </ul>  <h3 id=\"error_response\">エラーレスポンス</h3>  <p>APIリクエストでエラーが発生した場合は、エラー原因に応じたステータスコードおよびメッセージを返します。</p>    <table border=\"1\">   <tbody>     <tr>       <th style=\"padding: 10px\"><strong>ステータスコード</strong></th>       <th style=\"padding: 10px\"><strong>原因</strong></th>     </tr>     <tr><td style=\"padding: 10px\">400</td><td style=\"padding: 10px\">リクエストパラメータが不正</td></tr>     <tr><td style=\"padding: 10px\">401</td><td style=\"padding: 10px\">アクセストークンが無効</td></tr>     <tr><td style=\"padding: 10px\">403</td><td style=\"padding: 10px\">アクセス権限がない</td></tr>     <tr><td style=\"padding: 10px\">404</td><td style=\"padding: 10px\">リソースが存在しない</td></tr>     <tr><td style=\"padding: 10px\">429</td><td style=\"padding: 10px\">リクエスト回数制限を超えた</td></tr>     <tr><td style=\"padding: 10px\">503</td><td style=\"padding: 10px\">システム内で予期しないエラーが発生</td></tr>   </tbody> </table>  <p>メッセージボディ内の <code>messages</code> にはエラー内容を説明する文字列が入ります。</p> <pre><code>  {     &quot;status_code&quot; : 400,     &quot;errors&quot; : [       {         &quot;type&quot; : &quot;bad_request&quot;,         &quot;messages&quot; : [           &quot;リクエストの形式が不正です。&quot;         ]       }     ]   }  </code></pre>  </br>  <h3 id=\"api_rate_limit\">API使用制限</h3> <p>APIリクエストは1時間で5000回を上限としています。API使用ステータスはレスポンスヘッダに付与されます。</p> <pre><code>X-Ratelimit-Limit:5000 X-Ratelimit-Remaining:4998 X-Ratelimit-Reset:2018-01-01T12:00:00.000000Z </code></pre>  <br> 各ヘッダの意味は次のとおりです。</p>   <table border=\"1\">   <tbody>     <tr>       <th style=\"padding: 10px\"><strong>ヘッダ名</strong></th>       <th style=\"padding: 10px\"><strong>説明</strong></th>     </tr>     <tr><td style=\"padding: 10px\">X-RateLimit-Limit</td><td style=\"padding: 10px\">使用回数の上限</td></tr>     <tr><td style=\"padding: 10px\">X-RateLimit-Remaining</td><td style=\"padding: 10px\">残り使用回数</td></tr>     <tr><td style=\"padding: 10px\">X-RateLimit-Reset</td><td style=\"padding: 10px\">使用回数がリセットされる時刻</td></tr>   </tbody> </table>  <p>上記に加え、freeeは一定期間に過度のアクセスを検知した場合、APIアクセスをコントロールする場合があります。<br> その際のhttp status codeは403となります。制限がかかってから10分程度が過ぎると再度使用することができるようになります。</p>  </br>  <h3 id=\"accounting_master_items\">会計マスタ項目</h3>  <p>freee請求書APIのリクエストパラメータに、会計マスタ項目（例：<a href=\"https://developer.freee.co.jp/reference/iv/reference#operations-tag-Invoices\">POST/invoices請求書の作成</a> 取引先ID）があります。会計マスタ項目の詳細は<a href=\"https://developer.freee.co.jp/guideline/master-guideline\">会計マスタガイドラインを参照ください</a>。</p>  <p>会計のマスタ項目はfreee会計APIのエンドポイントにて取得可能です（例：<a href=\"https://developer.freee.co.jp/reference/accounting/reference#operations-tag-Partners\">Partners 取引先</a>）。freee会計APIのエンドポイントの詳細は<a href=\"https://developer.freee.co.jp/reference/accounting/reference\">会計APIリファレンスを参照ください</a>。</p>  </br>
 *
 * The version of the OpenAPI document: v1
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */
namespace OpenAPI\Client\Model;

use ArrayAccess;
use OpenAPI\Client\ObjectSerializer;

/**
 * QuotationRequestLines Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 *
 * @implements \ArrayAccess<TKey, TValue>
 *
 * @template TKey int|null
 * @template TValue mixed|null
 */
class QuotationRequestLines implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'QuotationRequest_lines';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'type'             => 'string',
        'description'      => 'string',
        'unit'             => 'string',
        'quantity'         => 'float',
        'unit_price'       => 'string',
        'tax_rate'         => 'int',
        'reduced_tax_rate' => 'bool',
        'withholding'      => 'bool',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @var string[]
     *
     * @phpstan-var array<string, string|null>
     *
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'type'             => null,
        'description'      => null,
        'unit'             => null,
        'quantity'         => null,
        'unit_price'       => null,
        'tax_rate'         => null,
        'reduced_tax_rate' => null,
        'withholding'      => null,
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'type'             => 'type',
        'description'      => 'description',
        'unit'             => 'unit',
        'quantity'         => 'quantity',
        'unit_price'       => 'unit_price',
        'tax_rate'         => 'tax_rate',
        'reduced_tax_rate' => 'reduced_tax_rate',
        'withholding'      => 'withholding',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'type'             => 'setType',
        'description'      => 'setDescription',
        'unit'             => 'setUnit',
        'quantity'         => 'setQuantity',
        'unit_price'       => 'setUnitPrice',
        'tax_rate'         => 'setTaxRate',
        'reduced_tax_rate' => 'setReducedTaxRate',
        'withholding'      => 'setWithholding',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'type'             => 'getType',
        'description'      => 'getDescription',
        'unit'             => 'getUnit',
        'quantity'         => 'getQuantity',
        'unit_price'       => 'getUnitPrice',
        'tax_rate'         => 'getTaxRate',
        'reduced_tax_rate' => 'getReducedTaxRate',
        'withholding'      => 'getWithholding',
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const TYPE_ITEM   = 'item';
    const TYPE_TEXT   = 'text';
    const TAX_RATE_0  = 0;
    const TAX_RATE_8  = 8;
    const TAX_RATE_10 = 10;

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_ITEM,
            self::TYPE_TEXT,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getTaxRateAllowableValues()
    {
        return [
            self::TAX_RATE_0,
            self::TAX_RATE_8,
            self::TAX_RATE_10,
        ];
    }

    /**
     * Associative array for storing property values.
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor.
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['type']             = $data['type'] ?? 'item';
        $this->container['description']      = $data['description'] ?? null;
        $this->container['unit']             = $data['unit'] ?? null;
        $this->container['quantity']         = $data['quantity'] ?? null;
        $this->container['unit_price']       = $data['unit_price'] ?? null;
        $this->container['tax_rate']         = $data['tax_rate'] ?? null;
        $this->container['reduced_tax_rate'] = $data['reduced_tax_rate'] ?? false;
        $this->container['withholding']      = $data['withholding'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['description']) && (mb_strlen($this->container['description']) > 255)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['description']) && (mb_strlen($this->container['description']) < 1)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['unit']) && (mb_strlen($this->container['unit']) > 255)) {
            $invalidProperties[] = "invalid value for 'unit', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['unit']) && (mb_strlen($this->container['unit']) < 1)) {
            $invalidProperties[] = "invalid value for 'unit', the character length must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['quantity']) && ($this->container['quantity'] > 99999999.999)) {
            $invalidProperties[] = "invalid value for 'quantity', must be smaller than or equal to 99999999.999.";
        }

        if (!is_null($this->container['quantity']) && ($this->container['quantity'] < -99999999.999)) {
            $invalidProperties[] = "invalid value for 'quantity', must be bigger than or equal to -99999999.999.";
        }

        if (!is_null($this->container['unit_price']) && !preg_match('/^\\-?[0-9]{0,13}(\\.[0-9]{1,3})?$/', $this->container['unit_price'])) {
            $invalidProperties[] = "invalid value for 'unit_price', must be conform to the pattern /^\\-?[0-9]{0,13}(\\.[0-9]{1,3})?$/.";
        }

        $allowedValues = $this->getTaxRateAllowableValues();
        if (!is_null($this->container['tax_rate']) && !in_array($this->container['tax_rate'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'tax_rate', must be one of '%s'",
                $this->container['tax_rate'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed.
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type.
     *
     * @param string|null $type 明細の種類 - item: 品目行   - tax_rate、quantityは必須になります。 - text: テキスト行   - descriptionのみ入力可能です。 - 入力がない場合、itemが利用されます。
     *
     * @return self
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description.
     *
     * @param string|null $description 摘要（品名）
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (!is_null($description) && (mb_strlen($description) > 255)) {
            throw new \InvalidArgumentException('invalid length for $description when calling QuotationRequestLines., must be smaller than or equal to 255.');
        }
        if (!is_null($description) && (mb_strlen($description) < 1)) {
            throw new \InvalidArgumentException('invalid length for $description when calling QuotationRequestLines., must be bigger than or equal to 1.');
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets unit.
     *
     * @return string|null
     */
    public function getUnit()
    {
        return $this->container['unit'];
    }

    /**
     * Sets unit.
     *
     * @param string|null $unit 明細の単位名
     *
     * @return self
     */
    public function setUnit($unit)
    {
        if (!is_null($unit) && (mb_strlen($unit) > 255)) {
            throw new \InvalidArgumentException('invalid length for $unit when calling QuotationRequestLines., must be smaller than or equal to 255.');
        }
        if (!is_null($unit) && (mb_strlen($unit) < 1)) {
            throw new \InvalidArgumentException('invalid length for $unit when calling QuotationRequestLines., must be bigger than or equal to 1.');
        }

        $this->container['unit'] = $unit;

        return $this;
    }

    /**
     * Gets quantity.
     *
     * @return float|null
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity.
     *
     * @param float|null $quantity 明細の数量 (整数部は8桁まで、小数部は3桁まで)
     *
     * @return self
     */
    public function setQuantity($quantity)
    {

        if (!is_null($quantity) && ($quantity > 99999999.999)) {
            throw new \InvalidArgumentException('invalid value for $quantity when calling QuotationRequestLines., must be smaller than or equal to 99999999.999.');
        }
        if (!is_null($quantity) && ($quantity < -99999999.999)) {
            throw new \InvalidArgumentException('invalid value for $quantity when calling QuotationRequestLines., must be bigger than or equal to -99999999.999.');
        }

        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets unit_price.
     *
     * @return string|null
     */
    public function getUnitPrice()
    {
        return $this->container['unit_price'];
    }

    /**
     * Sets unit_price.
     *
     * @param string|null $unit_price 明細の単価 (整数部は13桁まで、小数部は3桁まで)
     *
     * @return self
     */
    public function setUnitPrice($unit_price)
    {

        if (!is_null($unit_price) && (!preg_match('/^\\-?[0-9]{0,13}(\\.[0-9]{1,3})?$/', $unit_price))) {
            throw new \InvalidArgumentException("invalid value for $unit_price when calling QuotationRequestLines., must conform to the pattern /^\\-?[0-9]{0,13}(\\.[0-9]{1,3})?$/.");
        }

        $this->container['unit_price'] = $unit_price;

        return $this;
    }

    /**
     * Gets tax_rate.
     *
     * @return int|null
     */
    public function getTaxRate()
    {
        return $this->container['tax_rate'];
    }

    /**
     * Sets tax_rate.
     *
     * @param int|null $tax_rate 税率（%）（帳票の税率計算に用います。）
     *
     * @return self
     */
    public function setTaxRate($tax_rate)
    {
        $allowedValues = $this->getTaxRateAllowableValues();
        if (!is_null($tax_rate) && !in_array($tax_rate, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'tax_rate', must be one of '%s'",
                    $tax_rate,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tax_rate'] = $tax_rate;

        return $this;
    }

    /**
     * Gets reduced_tax_rate.
     *
     * @return bool|null
     */
    public function getReducedTaxRate()
    {
        return $this->container['reduced_tax_rate'];
    }

    /**
     * Sets reduced_tax_rate.
     *
     * @param bool|null $reduced_tax_rate 軽減税率対象（true: 対象、 false: 対象外）trueはtax_rate:8の時のみ指定可能です。
     *
     * @return self
     */
    public function setReducedTaxRate($reduced_tax_rate)
    {
        $this->container['reduced_tax_rate'] = $reduced_tax_rate;

        return $this;
    }

    /**
     * Gets withholding.
     *
     * @return bool|null
     */
    public function getWithholding()
    {
        return $this->container['withholding'];
    }

    /**
     * Sets withholding.
     *
     * @param bool|null $withholding 源泉徴収対象
     *
     * @return self
     */
    public function setWithholding($withholding)
    {
        $this->container['withholding'] = $withholding;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param int $offset Offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param int $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     *               of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object.
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
