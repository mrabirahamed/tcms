<?php if (isset($this->pagination)): ?>
    <table class="table">
        <tr>
            <td width="100px">
                <div class="text-align-left">
                    Pages <?php echo $this->pagination['current']; ?> of <?php echo $this->pagination['total']; ?>.
                </div>
            </td>
            <td>
                <div class="text-align-center">
                    <div class="pagination">
                        <?php if ($this->pagination['first']): ?>
                            <a class="page" page="<?php echo $this->pagination['first']; ?>" href="javascript:void(0)">&Lt;</a>
                        <?php else: ?>
                            <a>&Lt;</a>
                        <?php endif; ?>
                        <?php if ($this->pagination['previous']): ?>
                            <a class="page" page="<?php echo $this->pagination['previous']; ?>"
                               href="javascript:void(0)">&LT;</a>
                        <?php else: ?>
                            <a>&LT;</a>
                        <?php endif; ?>
                        <?php for ($i = 0; $i < count($this->pagination['range']); $i++): ?>
                            <?php if ($this->pagination['current'] === $this->pagination['range'][$i]): ?>
                                <a class="active"><?php echo $this->pagination['range'][$i]; ?></a>
                            <?php else: ?>
                                <a class="page" page="<?php echo $this->pagination['range'][$i]; ?>"
                                   href="javascript:void(0)"><?php echo $this->pagination['range'][$i]; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($this->pagination['next']): ?>
                            <a class="page" page="<?php echo $this->pagination['next']; ?>" href="javascript:void(0)">&GT;</a>
                        <?php else: ?>
                            <a>&GT;</a>
                        <?php endif; ?>
                        <?php if ($this->pagination['last']): ?>
                            <a class="page" page="<?php echo $this->pagination['last']; ?>" href="javascript:void(0)">&Gt;</a>
                        <?php else: ?>
                            <a>&Gt;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
<?php endif; ?>

