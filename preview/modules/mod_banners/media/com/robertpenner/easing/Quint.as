class com.robertpenner.easing.Quint
{
    function Quint()
    {
    } // End of the function
    static function easeIn(t, b, c, d)
    {
        t = t / d;
        return (c * (t) * t * t * t * t + b);
    } // End of the function
    static function easeOut(t, b, c, d)
    {
        t = t / d - 1;
        return (c * ((t) * t * t * t * t + 1) + b);
    } // End of the function
    static function easeInOut(t, b, c, d)
    {
        t = t / (d / 2);
        if (t < 1)
        {
            return (c / 2 * t * t * t * t * t + b);
        } // end if
        t = t - 2;
        return (c / 2 * ((t) * t * t * t * t + 2) + b);
    } // End of the function
    static function easeOutIn(t, b, c, d)
    {
        t = t / (d / 2);
        return (c / 2 * (--t * t * t * t * t + 1) + b);
    } // End of the function
} // End of Class
