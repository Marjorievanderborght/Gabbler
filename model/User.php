<?php

use Cassandra\Date;

class User extends MappingTableAbstract
{

    const MIN = 5;

    protected int $id_user;
    protected string $nickname_user;
    protected string $pwd_user;
    protected string $mail_user;
    protected string $signup_date_user;
    protected string $color_user;
    protected string $confirmation_key_user;
    protected int $validation_status_key = 1;

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @return string
     */
    public function getNicknameUser(): string
    {
        return $this->nickname_user;
    }

    /**
     * @return string
     */
    public function getPwdUser(): string
    {
        return $this->pwd_user;
    }

    /**
     * @return string
     */
    public function getMailUser(): string
    {
        return $this->mail_user;
    }

    /**
     * @return string
     */
    public function getSignupDateUser(): string
    {
        return $this->signup_date_user;
    }

    /**
     * @return string
     */
    public function getColorUser(): string
    {
        return $this->color_user;
    }

    /**
     * @return string
     */
    public function getConfirmationKeyUser(): string
    {
        return $this->confirmation_key_user;
    }

    /**
     * @return int
     */
    public function getValidationStatusKey(): int
    {
        return $this->validation_status_key;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        if (!is_int($id_user) && empty($id_user)) {
            trigger_error('The user ID is not valid', E_USER_NOTICE);
        } else {
            $this->id_user = $id_user;
        }
    }

    /**
     * @param string $nickname_user
     */
    public function setNicknameUser(string $nickname_user): void
    {
        if (strlen($nickname_user) < self::MIN || strlen($nickname_user) > 60) {
            trigger_error('The length of the nickname must be between ' . self::MIN . ' and 60 characters', E_USER_NOTICE);
        } else if (empty($nickname_user)) {
            trigger_error('The nickname cannot be empty', E_USER_NOTICE);
        } else {
            $this->nickname_user = $nickname_user;
        }
    }

    /**
     * @param string $pwd_user
     */
    public function setPwdUser(string $pwd_user): void
    {
        if (strlen($pwd_user) < self::MIN && strlen($pwd_user) > 255) {
            trigger_error('The length of the password must be between ' . self::MIN . ' and 255 characters', E_USER_NOTICE);
        } else if (empty($pwd_user)) {
            trigger_error('The password cannot be empty', E_USER_NOTICE);
        } else {
            $this->pwd_user = $pwd_user;
        }
    }

    /**
     * @param string $mail_user
     */
    public function setMailUser(string $mail_user): void
    {
        if (!filter_var($mail_user, FILTER_VALIDATE_EMAIL)) {
            trigger_error('The email address is not valid', E_USER_NOTICE);
        } else if (strlen($mail_user) < self::MIN && strlen($mail_user) > 120) {
            trigger_error('The length of the email address must be between ' . self::MIN . ' and 120 characters', E_USER_NOTICE);
        } else {
            $this->mail_user = $mail_user;
        }
    }

    /**
     * @param string $signup_date_user
     */
    public function setSignupDateUser(string $signup_date_user): void
    {
        $verifyDate = new Date($signup_date_user);
        if (!is_object($verifyDate)) {
            trigger_error('The registration date is not valid', E_USER_NOTICE);
        } else if (empty($signup_date_user)) {
            trigger_error('The registration date cannot be empty', E_USER_NOTICE);
        } else {
            $this->signup_date_user = $signup_date_user;
        }
    }

    /**
     * @param string $color_user
     */
    public function setColorUser(string $color_user): void
    {
        if (!(is_string($color_user) && is_array(json_decode($color_user)))) {
            trigger_error('The color table is not valid', E_USER_NOTICE);
        } else if (strlen($color_user) < self::MIN && strlen($color_user) > 45) {
            trigger_error('The length of the color table must be between ' . self::MIN . ' and 45 characters', E_USER_NOTICE);
        } else if (empty($color_user)) {
            trigger_error('The color table cannot be empty', E_USER_NOTICE);
        } else {
            $this->color_user = $color_user;
        }
    }

    /**
     * @param string $confirmation_key_user
     */
    public function setConfirmationKeyUser(string $confirmation_key_user): void
    {
        if (strlen($confirmation_key_user) < self::MIN && strlen($confirmation_key_user) > 60) {
            trigger_error('The length of the confirmation key must be between ' . self::MIN . ' and 60 characters', E_USER_NOTICE);
        } else if (empty($confirmation_key_user)) {
            trigger_error('The confirmation key cannot be empty', E_USER_NOTICE);
        } else {
            $this->confirmation_key_user = $confirmation_key_user;
        }
    }

    /**
     * @param int $validation_status_key
     */
    public function setValidationStatusKey(int $validation_status_key): void
    {
        if (!is_int($validation_status_key)) {
            trigger_error('The status is not valid', E_USER_NOTICE);
        } else if (empty($validation_status_key)) {
            trigger_error('The status cannot be empty', E_USER_NOTICE);
        } else {
            $this->validation_status_key = $validation_status_key;
        }
    }
}