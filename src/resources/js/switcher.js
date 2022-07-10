/**
 * sortTable() is a function to go through the rows of a table and sort.
 *
 * Citation - This function is largely from w3school.com - with some minor adjustments to make it do this assignment.
 *
 * @param rowNumber
 */
function sortTable(rowNumber) {
    let table;
    let rows, switching, i, x, y, switchMe, dir, switchCount = 0;
    table = document.getElementById('people');
    switching = true;
    // Set the sorting direction to ascending.
    dir = 'ASC';
    /**
     * Make a loop that will continue until
     * no switching has been done
     **/
    while (switching) {
        // No switching to start
        switching = false;
        rows = table.rows;
        /**
         * Loop through all table rows (except the
         * first, which contains table headers)
         **/
        for (i = 1; i < (rows.length - 1); i++) {
            // No switching to start
            switchMe = false;
            /**
             * Get the two elements you want to compare,
             * one from current row and one from the next
             **/
            x = rows[i].getElementsByTagName('td')[rowNumber];
            y = rows[i + 1].getElementsByTagName('td')[rowNumber];
            /**
             * Check if the two rows should switch place,
             * based on the direction, ASC or DESC.
             **/
            if (dir === 'ASC') {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop.
                    switchMe= true;
                    break;
                }
            } else if (dir === 'DESC') {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop.
                    switchMe = true;
                    break;
                }
            }
        }
        if (switchMe) {
            /**
             * If a switch has been marked, make the switch
             * and mark that a switch has been done
             **/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1.
            switchCount++;
        } else {
            /**
             * If no switching has been done AND the direction is 'ASC',
             * set the direction to 'DESC' and run the while loop again
             **/
            if (switchCount === 0 && dir === 'ASC') {
                dir = 'DESC';
                switching = true;
            }
        }
    }
}