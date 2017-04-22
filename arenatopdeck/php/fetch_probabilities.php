<?php
/* Variables. */
$output = '';

/* Do this on POST request. */
if (isset($_POST["query"])) {
    // .= appends to a string
    $output .= '
        <table>
            <tr>
                <td>Total</td>
                <td>7 cards</td>
            </tr>
            <tr>
                <td><p>Class card</p> (*cough*
                    <a href="cards/kalimos_primal_lord">Kalimos, Primal Lord)</a></td>
                <td>~17.56%</td>
            </tr>
            <tr>
                <td>Neutral card</td>
                <td>~4.61%</td>
            </tr>
            <tr>
                <td>3 cards</td>
                <td>~18.70%</td>
            </tr>
         </table>
    ';
    echo $output;
}
/* No results. */
else {
    echo 'No results found.';
}
