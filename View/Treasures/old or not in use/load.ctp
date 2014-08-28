<?php
echo 'Enter the correct code and email to load your gallery';
echo $this->Form->create('Load');
echo $this->Form->input('editcode');
echo $this->Form->input('email');
echo $this->Form->end(__('Submit'));
