<div class="container">     

  <!-- Portfolio row of columns -->
  <div id="productList" class="row">
    <div class="span12 titleTop">
      <h1 class="floatLeft">Diario</h1>
    </div>

    <div class="span10 smallTableCenter">      
      <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">Todos</a></li>
          <li><?php if($this->Account_Model->get_profile() == '1' || $this->Account_Model->get_profile() == '2'){ ?>
            <!-- Button to trigger modal -->
            <a href="#modal-diarycreate" role="button" class="btnAdd btnTitle btn btn-primary" data-toggle="modal">Nuevo</a>

            <!-- Modal -->
            <div id="modal-diarycreate" class="modal hide fade modalbig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Adicionar Pago</h3>
              </div>
              <div class="modal-body">
                
                <fieldset>
                  <input id="btnAddModal" class="btn btn-primary" type="submit"  value="+" />
                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data-tabled" width="100%">
                    <thead>
                      <tr>
                        <th class="center">Distribuidor</th>
                        <th class="center">Cliente</th>
                        <th class="center">Fecha</th>
                        <th class="center">Voucher</th>
                        <th class="center">Monto</th>
                        <th class="center">Detalle</th>
                      </tr>
                    </thead>
                    <tbody id="diaryTableModal">
                      <tr class="even gradeX">
                        <td class="center" id ="distributorDropdown">
                          <?php
                            echo form_dropdown('distributor', $distributor, '', 'class="" ');
                          ?>
                        </td>
                        <td class="" id ="clientDropdown">
                          <?php
                            echo form_dropdown('client', $clients, '', 'class="" ');
                          ?>
                        </td>
                        <td class="center">
                          <?php 
                            echo form_input(array('name' => 'date', 'class' => 'datecontainer datepicker datemedium', 'value' => date("Y-m-d"))); 
                          ?>
                        </td> 
                        <td class="center"><input id="voucher" type="text" class="span1" value="" ></td>
                        <td class="center"><input id="ammount" type="text" class="span1" value="" ></td>
                        <td class="center"><textarea class="span2" rows="1" cols="0" id="detail" name="detail"></textarea></td>
                      </tr>
                    </tbody>
                  </table>
                </fieldset>

              </div>
              <div class="modal-footer">
                <?php echo anchor('diary', 'Cancelar', array('class' => 'btnTitle btn btn-info')); ?>
                <input class="btn btn-primary" type="submit" name="submit" id="btnSave" value="Guardar" />
              </div>
            </div>



          <?php } ?></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab1">
            <?php
              $data['category'] = 'client';
              $this->load->view('diary/tab1', $data);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<style type="text/css">
  #btnAddModal{
    float: right;
    margin: 0 20px 10px 0;
  }
  .datecontainer{
    width: 70px;
  }
</style>

<script type="text/javascript">
  // dropdown distributors
  var distrib = $("#distributorDropdown").html();
  // dropdown users
  var drop = $("#clientDropdown").html();

  var registry = "<tr class='even gradeX'>";
  registry += '<td class="center">' + distrib + '</td> ';
  registry += '<td class="center">' + drop + '</td> ';
  registry += '<td class="center"><input type="text" class="datecontainer datepicker2" value="<?php echo date("Y-m-d");?>" name="date"></td>';
  registry += '<td class="center"><input id="voucher" type="text" class="span1" value="" ></td>';
  registry += '<td class="center"><input id="ammount" type="text" class="span1" value="" ></td>';
  registry += '<td class="center"><textarea class="span2" rows="1" cols="0" id="detail" name="detail"></textarea></td>';
  registry += "</tr>";

  $(document).ready(function(){
    $("#btnAddModal").click(function(){
      $("#diaryTableModal").append(registry);
      $(".datepicker2").datepicker();
    });

    $("#btnSave").click(function(){
      //showLoadingAnimation($('#clientDropdown'));
      client = "";
      date = "";
      voucher = "";
      ammount = "";
      detail = "";

      $("#diaryTableModal tr").each(function(){
        client += $(this).find("select[name='client']").val()+"***";
        date += $(this).find("input[name='date']").val()+"***";
        voucher += $(this).find("#voucher").val()+"***";
        ammount += $(this).find("#ammount").val()+"***";
        detail += $(this).find("#detail").val()+"***";
      });

      $.ajax({
        type: "POST",
        url: 'diary/saveblock',
        data: 'client='+client+'&date='+date+'&voucher='+voucher+'&ammount='+ammount+'&detail='+detail,
        dataType: 'json',
        cache: false,
        success: function(data) {
          //redirectxx();
        }
      })

      $('#diaryTableModal').modal('hide');
      //hideLoadingAnimation($('#clientDropdown'));
    });

  });
  
  function redirectxx(){
    <?php //redirect('diary'); ?>
  }
</script>