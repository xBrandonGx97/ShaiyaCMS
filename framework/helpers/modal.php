<?php
function display($ID, $Icon, $Pos = null, $Size = null, $Title = null)
{
    echo '<div class="modal nk-modal" id="'.$ID.'" tabindex="-1">';
        echo '<div class="modal-dialog'.modalPos($Pos).modalSize($Size).'" role="document">';
            echo '<div class="modal-content" style="background-color:rgba(000,000,000,0.8) !important;">';
                echo modalHeader($ID, $Icon, $Title);
                echo modalBody();
                echo modalFooter();
            echo '</div>';
        echo '</div>';
    echo '</div>';
}

function modalPos($data)
{
    switch ($data) {
        case '0':
            return '';
            break;
        case '1':
            return ' modal-dialog-centered ';
            break;
    }
}

function modalSize($data)
{
    switch ($data) {
        case '0':
            return '';
            break;
        case '1':
            return ' modal-sm';
            break;
        case '2':
            return ' modal-lg';
            break;
    }
}

function modalHeader($ID, $Icon, $Title)
{
    echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="'.$ID.'">'.$Icon.' '.$Title.'</h5>';
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span class="text-white" aria-hidden="true"><i class="fa fa-times-circle"></i></span>';
        echo '</button>';
    echo '</div>';
}

function modalBody()
{
    echo '<div class="modal-body">';
        echo '<div class="container-fluid">';
            echo '<div id="modal-loader">';
                echo '<div class="row">';
                    echo '<div class="col-md-6"></div>';
                    echo '<div class="col-md-2">';
                        echo '<div class="bt-spinner"></div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div id="dynamic-content"></div>';
        echo '</div>';
    echo '</div>';
}

function modalFooter()
{
    echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-danger" data-dismiss="modal">';
            echo '<i class="fa fa-times-circle"></i> Close</button>';
        //echo '<button type="button" class="btn btn-primary">Save changes</button>';
    echo '</div>';
}
