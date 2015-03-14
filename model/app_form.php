<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>New Appointment</legend>

<!-- Patien ID input-->
<div class="control-group">
  <label class="col-sm-2 control-label" for="pat_id">Patient ID:</label>
  <div class="controls col-sm-10">
    <input id="pat_id" name="pat_id" placeholder="abc###" class="input-medium" required="" type="text">
    <button id="autofill" name="autofill" class="btn btn-primary btn-xs">auto fill</button>
  </div>
</div>

<!-- Patient First Name input-->
<div class="control-group">
  <label class="control-label col-sm-2" for="fname">First Name:</label>
  <div class="controls col-sm-10">
    <input id="fname" name="fname" placeholder="name" class="input-medium" required="" type="text">
    
  </div>
</div>

<!-- Patien Last Name input-->
<div class="control-group">
  <label class="control-label col-sm-2" for="lname">Last Name</label>
  <div class="controls col-sm-10">
    <input id="lname" name="lname" placeholder="name" class="input-medium" required="" type="text">
    
  </div>
</div>

<!-- Doctor ID with Drop Down -->
<div class="control-group">
  <label class="control-label col-sm-2" for="doc_id">Attending Doctor ID:</label>
  <div class="controls col-sm-10">
    <div class="input-append">
      <input id="doc_id" name="doc_id" class="input-medium" placeholder="id" required="" type="text">
      <div class="btn-group">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
          List Doctor IDs
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="#">Option one</a></li>
          <li><a href="#">Option two</a></li>
          <li><a href="#">Option three</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Buttons Submit and Cancel -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-success">Submit</button>
    <button id="cancel" name="cancel" class="btn btn-danger">Cancel</button>
  </div>
</div>

</fieldset>
</form>
