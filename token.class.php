<?php
namespace hoangnamitc;
/**
 * Token Class
 *
 * @category  CSRF Anti
 * @package   Token
 * @author    hoangnamitc <hoangnamitc.com>
 * @copyright Copyright (c) 2018-2020
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @link      https://github.com/hoangnamitc/csrf-token
 * @version   2.1.0
 */
class Token {

    // Khai báo biến cho token
    protected $_name    = 'csrf';
    protected $_time    = 1;

    public function __construct( $tokenName = null ) {

        $this->checkExpiredTimer();

        if( !is_null($tokenName) ) {
            $this->setName( $tokenName );
        }

        if( !isset($_SESSION[$this->getName()]) ) {
            $_SESSION[$this->getName()] = array();
        }

    }

    /**
     *### Gán giá trị token
     *
     * Truyền '*' để gán liên tục
     *
     * @param string $creatTime
     * @return void
     */
    public function set( $creatTime = null, $liveTime = null ) {
        $value = $timer = null;

        // Tạo Token ko lặp
        if( !$this->getToken() ) {
            $value = $this->create();
        }
        else {
            $value = $this->getToken();
        }

        // Tạo nhiều lần
        if ( $creatTime === '*' ) {
            // Có đặt thời gian sống cho token
            if( !is_null($liveTime) ) {
                $this->setTime($liveTime);

                if( $this->checkExpiredTimer() ) {
                    $timer = ($this->_time + time());
                    $value = $this->create();
                }

            }
            // Không đặt thời gian sống cho token
            else {
                $value = $this->create();
            }

        }

        if( $this->checkExpiredTimer() ) {
            $_SESSION[$this->getName()] = array(
                $value => $timer
            );
        }
    }

    /**
     *### Trả về giá trị token
     *
     * @return void
     */
    private function get( $tokenName = null ) {
        if( !is_null($tokenName) ) {
            $this->setName($tokenName);
        }

        if( isset($_SESSION[$this->getName()]) ) {
            return $_SESSION[$this->getName()];
        }

        return false;
    }

    /**
     *### Đặt thời gian sống cho session (giây)
     *
     * @param int $time
     * @return void
     */
    private function setTime( $time ) {
        if( is_int($time) && is_numeric($time) ) {
            $this->_time = (int)$time;

            return true;
        }

        return false;
    }

    /**
     *### Tạo ra mã token
     *
     * @return void
     */
    private function create() {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $key = base64_encode(openssl_random_pseudo_bytes(32));
        } else {
            $key = sha1(mt_rand() . rand());
        }
        return $key;
    }

    /**
     *### Trả về tên Token
     *
     * @return void
     */
    public function getName() {
        return $this->_name;
    }

    /**
     *### Gán tên cho token
     *
     * @param string $tokenName
     * @return void
     */
    private function setName( $tokenName ) {
        $this->_name = $tokenName;
    }

    /**
     *### Kiểm tra tính hợp lệ Token
     *
     * @param string $token
     * @return void
     */
    public function validate( $tokenValue ) {
        return ($tokenValue === $this->getToken()) ? true : false;
    }

    /**
     *### Xóa bỏ Token
     *
     * @return void
     */
    public function delete() {

        if ( $this->getToken() ) {

            unset($_SESSION[$this->getName()]);
            return true;
        }
        return false;
    }

    /**
     * ### Trả về giá trị Token
     *
     * @return void
     */
    public function getToken() {

        if( $this->get() ){
            return array_keys($_SESSION[$this->getName()])[0];
        }

        return false;
    }

    /**
     *#### Trả về giá trị thời gian sống của token
     *
     * @return void
     */
    private function getTimer() {
        if( $this->get() ){

            return end($_SESSION[$this->getName()]);
        }

        return false;
    }

    /**
     *#### Kiểm tra thời gian sống của token còn hay hết
     *
     * @return void
     */
    private function checkExpiredTimer() {

        if( time() >= $this->getTimer() ) {
            return true;
        }
        return false;
    }

    /**
     *##### Hiển thị các thông số: (tgian hiện tại, Tên token, Token còn sống ko, giá trị token)
     *
     * @return void
     */
    public function debug() {
        echo "time): ".time()."<br/>";

        var_dump(
            $_SESSION[$this->getName()]
        );

        var_dump(
            $this->checkExpiredTimer()
        );

        var_dump(
            $this->getToken()
        );
    }

}
?>