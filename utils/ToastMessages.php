<?php

class ToastMessages
{

    /**
     * Add toast message to be shown on next page load.
     * 
     * @param $type Message type (color), one of the following: primary, secondary, success,
     *        danger, warning, info, light, dark.
     * @param $message Message text.
     */
    public static function Add($type, $message)
    {
        $_SESSION['toasts'][] = ['type' => $type, 'message' => $message];
    }

    /**
     * Returns all unread toast messages.
     * 
     * @return mixed An array of messages. Each message is in format [type, message].
     */
    public static function GetAll()
    {
        if (isset($_SESSION['toasts'])) {
            $data = $_SESSION['toasts'];
            unset($_SESSION['toasts']);
            return $data;
        } else {
            return [];
        }
    }
}
?>