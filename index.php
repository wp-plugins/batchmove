<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */
define(TACOLS,50);
define(TAROWS,5);
define(TAVALUE, "Product omschrijving");

?>
<HTML>
<HEAD>
    <TITLE> Add/Remove dynamic rows in HTML table </TITLE>
    <SCRIPT language="javascript">
        /**
         *
         * @access public
         * @return void
         **/
        /**
          *
          * @access public
          * @return void
          **/
        function calculate(obj){
         	alert(obj.name);
        }
        function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var lastRow = table.rows[rowCount-1];
            var lastId = parseInt(lastRow.cells[1].firstChild.nodeValue) + 1;
            lastId = eval(lastId);
            var row = table.insertRow(rowCount);
            row.id = rowCount;
            row.vAlign = "top";//if you want all top-vAlign

            var cell1 = row.insertCell(0);
//            cell1.vAlign="top";
            var element1 = document.createElement("input");
            element1.type = "checkbox";
            element1.id = "cb_1_" + lastId;
            element1.name = "cb_1_" + lastId;
            cell1.appendChild(element1);

            var cell2 = row.insertCell(1);
//            cell2.vAlign="top";
			cell2.id = "top2";
            cell2.bgColor = "yellow";
            cell2.innerHTML = lastId;//rowCount + 1;

            var cell3 = row.insertCell(2);
//            cell3.vAlign="top";
            var element3 = document.createElement("input");
            element3.type = "text";
            element3.id = "txt_3_" + lastId;
            element3.name = "txt_3_" + lastId;
            cell3.appendChild(element3);

            var cell4 = row.insertCell(3);
//            cell4.vAlign="top";
            var element4 = document.createElement("textarea");
            element4.cols = <?php echo TACOLS;?>;
            element4.rows = <?php echo TAROWS;?>;
            element4.id = "txta_4_" + lastId;
            element4.name = "txta_4_" + lastId;
            element4.value = <?php echo '"' . TAVALUE . '"';?> + " " + lastId;
            cell4.appendChild(element4);

            var cell5 = row.insertCell(4);
//            cell5.vAlign="top";
            var element5 = document.createElement("input");
            element5.setAttribute('onBlur', "calculate(this)");
            element5.type = "text";
            element5.id = "txt_5_" + lastId;
            element5.name = "txt_5_" + lastId;
            cell5.appendChild(element5);

        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    //i--;
                }

            }
            }catch(e) {
                alert(e);
            }
        }

    </SCRIPT>
</HEAD>
<BODY>

    <INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />

    <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />

    <TABLE id="dataTable" border="1">
        <TR valign="top">
            <TD><INPUT type="checkbox" name="cb_1_1" id="cb_1_1"/></TD>
            <TD style="background:yellow"> 1 </TD>
            <TD> <INPUT type="text" id="txt_3_1" name="txt_3_1" /> </TD>
            <TD> <textarea id="txta_4_1" name="txta_4_1" cols="<?php echo TACOLS;?>"
            		rows="<?php echo TAROWS;?>" ><?php echo TAVALUE . " 1";?></textarea></TD>
            <TD> <INPUT type="text" id="txt_5_1" name="txt_5_1"  /> </TD>
        </TR>
    </TABLE>

</BODY>
</HTML>