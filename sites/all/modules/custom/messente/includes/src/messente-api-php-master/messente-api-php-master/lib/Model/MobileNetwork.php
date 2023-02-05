<?php
/**
 * MobileNetwork
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  Messente\Api
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Messente API
 *
 * [Messente](https://messente.com) is a global provider of messaging and user verification services.  * Send and receive SMS, Viber, WhatsApp and Telegram messages. * Manage contacts and groups. * Fetch detailed info about phone numbers. * Blacklist phone numbers to make sure you're not sending any unwanted messages.  Messente builds [tools](https://messente.com/documentation) to help organizations connect their services to people anywhere in the world.
 *
 * The version of the OpenAPI document: 2.0.0
 * Contact: messente@messente.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Messente\Api\Model;

use \ArrayAccess;
use \Messente\Api\ObjectSerializer;

/**
 * MobileNetwork Class Doc Comment
 *
 * @category Class
 * @description Info about the network related to the phone number
 * @package  Messente\Api
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class MobileNetwork implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MobileNetwork';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'mccmnc' => 'string',
        'networkName' => 'string',
        'countryName' => 'string',
        'countryPrefix' => 'string',
        'countryCode' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'mccmnc' => null,
        'networkName' => null,
        'countryName' => null,
        'countryPrefix' => null,
        'countryCode' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'mccmnc' => 'mccmnc',
        'networkName' => 'networkName',
        'countryName' => 'countryName',
        'countryPrefix' => 'countryPrefix',
        'countryCode' => 'countryCode'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'mccmnc' => 'setMccmnc',
        'networkName' => 'setNetworkName',
        'countryName' => 'setCountryName',
        'countryPrefix' => 'setCountryPrefix',
        'countryCode' => 'setCountryCode'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'mccmnc' => 'getMccmnc',
        'networkName' => 'getNetworkName',
        'countryName' => 'getCountryName',
        'countryPrefix' => 'getCountryPrefix',
        'countryCode' => 'getCountryCode'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
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


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['mccmnc'] = $data['mccmnc'] ?? null;
        $this->container['networkName'] = $data['networkName'] ?? null;
        $this->container['countryName'] = $data['countryName'] ?? null;
        $this->container['countryPrefix'] = $data['countryPrefix'] ?? null;
        $this->container['countryCode'] = $data['countryCode'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets mccmnc
     *
     * @return string|null
     */
    public function getMccmnc()
    {
        return $this->container['mccmnc'];
    }

    /**
     * Sets mccmnc
     *
     * @param string|null $mccmnc Mobile country and mobile network code
     *
     * @return self
     */
    public function setMccmnc($mccmnc)
    {
        $this->container['mccmnc'] = $mccmnc;

        return $this;
    }

    /**
     * Gets networkName
     *
     * @return string|null
     */
    public function getNetworkName()
    {
        return $this->container['networkName'];
    }

    /**
     * Sets networkName
     *
     * @param string|null $networkName Mobile network name
     *
     * @return self
     */
    public function setNetworkName($networkName)
    {
        $this->container['networkName'] = $networkName;

        return $this;
    }

    /**
     * Gets countryName
     *
     * @return string|null
     */
    public function getCountryName()
    {
        return $this->container['countryName'];
    }

    /**
     * Sets countryName
     *
     * @param string|null $countryName Country name
     *
     * @return self
     */
    public function setCountryName($countryName)
    {
        $this->container['countryName'] = $countryName;

        return $this;
    }

    /**
     * Gets countryPrefix
     *
     * @return string|null
     */
    public function getCountryPrefix()
    {
        return $this->container['countryPrefix'];
    }

    /**
     * Sets countryPrefix
     *
     * @param string|null $countryPrefix Country prefix
     *
     * @return self
     */
    public function setCountryPrefix($countryPrefix)
    {
        $this->container['countryPrefix'] = $countryPrefix;

        return $this;
    }

    /**
     * Gets countryCode
     *
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->container['countryCode'];
    }

    /**
     * Sets countryCode
     *
     * @param string|null $countryCode Country code
     *
     * @return self
     */
    public function setCountryCode($countryCode)
    {
        $this->container['countryCode'] = $countryCode;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
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
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
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
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

