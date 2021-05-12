<?php if (isset($this->pagination)): ?>
    <div class="text-align-center">
        <div class="pagination">
            <?php if ($this->pagination['first']): ?>
                <a href="<?php echo $link . $this->pagination['first']; ?>">First</a>
            <?php else: ?>
                <a>First</a>
            <?php endif; ?>
            <?php if ($this->pagination['previous']): ?>
                <a href="<?php echo $link . $this->pagination['previous']; ?>">Previous</a>
            <?php else: ?>
                <a>Previous</a>
            <?php endif; ?>

            <?php for ($i = 0; $i < count($this->pagination['range']); $i++): ?>
                <?php if ($this->pagination['current'] === $this->pagination['range'][$i]): ?>
                    <a class="active"><?php echo $this->pagination['range'][$i]; ?></a>
                <?php else: ?>
                    <a href="<?php echo $link . $this->pagination['range'][$i]; ?>"><?php echo $this->pagination['range'][$i]; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($this->pagination['next']): ?>
                <a href="<?php echo $link . $this->pagination['next']; ?>">Next</a>
            <?php else: ?>
                <a>Next</a>
            <?php endif; ?>
            <?php if ($this->pagination['last']): ?>
                <a href="<?php echo $link . $this->pagination['last']; ?>">Last</a>
            <?php else: ?>
                <a>Last</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
