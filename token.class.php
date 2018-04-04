<?php
namespace hoangnamitc;
/**
* LỚP TOKEN
*/
class Token {

    // Khai báo biến cho token
    protected $_name  = 'csrf';

    function __construct( $tokenName = null ) {

        if( $tokenName && !empty($tokenName) && !is_null($tokenName) ) {
            $this->setName( $tokenName );
        }

    }

    /**
     *### Trả về giá trị token
     *
     * @return void
     */
    public function get( $tokenName = null ) {
        $return = null;

        if( $tokenName && !is_null($tokenName) ) {
            $this->setName($tokenName);
        }

        if( isset($_SESSION[$this->getNameFull()]) ) {
            $return = $_SESSION[$this->getNameFull()];
        }
        return $return;

    }

    /**
     *### Gán giá trị token
     *
     * Truyền '*' để gán liên tục
     *
     * @param string $timesCreate
     * @return void
     */
    public function set( $timesCreate = null ) {
        $value = null;
        // Tạo nhiều lần
        if ( $timesCreate === '*' ) {
            $value = $this->create();
        } else {
        // Tạo 1 lần
            if( !$this->get() ) {
                $value = $this->create();
            }
            else {
                $value = $this->get();
            }
        }
        $_SESSION[$this->getNameFull()] = $value;
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
     *### Trả về tên đầy đủ Token
     *
     * @return void
     */
    private function getNameFull() {
        return 'token_'.$this->_name;
    }

    /**
     *### Kiểm tra tính hợp lệ Token
     *
     * @param string $token
     * @return void
     */
    public function validate( $tokenValue ) {
        return $tokenValue === $this->get() ? true : false;
    }

    /**
     *### Xóa bỏ Token
     *
     * @return void
     */
    public function delete() {
        if ( $this->validate($this->get()) ) {
            unset($_SESSION[$this->getNameFull()]);
            return true;
        }
        return false;
    }

    /**
     *### Xóa bỏ tất cả token
     *
     * @return void
     */
    public function deleteAll() {
        foreach ($_SESSION as $kToken => $vToken) {
            if ( strpos( $kToken, 'token_' ) === 0 ) {
                unset($_SESSION[$kToken]);
            }
        }
    }

}
?>