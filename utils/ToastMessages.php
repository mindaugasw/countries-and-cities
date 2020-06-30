<?php

/**
 * Class for showing Toast messages to the user.
 */
class ToastMessages
{

    /**
     * Add toast message to be shown on next page load.
     * 
     * @param string $type Message type (color), one of the following: primary, secondary, success,
     *        danger, warning, info, light, dark.
     * @param string $message Message text.
     */
    public static function Add(string $type, string $message)
    {
        $_SESSION['toasts'][] = ['type' => $type, 'message' => $message];
    }

    /**
     * Returns all toast messages and removes them from session (same messages will not be returned again).
     * 
     * @return mixed An array of messages. Format: [[type, message], ...].
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