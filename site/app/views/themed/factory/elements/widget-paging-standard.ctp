                    	<div class="paging">
                            <table width="580" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                  <td width="100">
                                      <?php echo $paginator->prev(__('<< Previous',true),array('class' => 'PrevPg'),null,array('class' => 'PrevPg DisabledPgLk')); ?>
                                  </td>
                                  <td width="387" align="center">
                                        <?php echo $paginator->numbers(array('class' => 'numbers', 'separator' => '')); ?>
		                      </td>
                                  <td width="100">                    
                                        <?php echo $paginator->next(__('Next >>',true), array('class' => 'NextPg'),null, array('class' => 'NextPg DisabledPgLk')); ?>
                                  </td>
                                </tr>
                            </table>
                        </div>