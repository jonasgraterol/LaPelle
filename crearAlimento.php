
<div id="message_sent" style="display:none;">
					<h2>Enviando</h2>
					<p>Por favar espere.</p>
					<img src='images/cargando.gif' alt='Enviando...' class="cargaMsj" /> Enviando...
					
</div>

<form class="niceform">  
     <fieldset>
    	<legend>Preferences</legend>
        <dl>
        	<dt><label for="color">Favorite Color:</label></dt>
            <dd>
            	<input type="radio" name="color" id="colorBlue" value="Blue" /><label for="colorBlue" class="opt">Blue</label>
                <input type="radio" name="color" id="colorRed" value="Red" /><label for="colorRed" class="opt">Red</label>
                <input type="radio" name="color" id="colorGreen" value="Green" /><label for="colorGreen" class="opt">Green</label>
            </dd>
        </dl>
        <dl>
        	<dt><label for="interests">Interests:</label></dt>
            <dd>
                <input type="checkbox" name="interests[]" id="interestsNews" value="News" /><label for="interestsNews" class="opt">News</label>
                <input type="checkbox" name="interests[]" id="interestsSports" value="Sports" /><label for="interestsSports" class="opt">Sports</label>
                <input type="checkbox" name="interests[]" id="interestsEntertainment" value="Entertainment" /><label for="interestsEntertainment" class="opt">Entertainment</label>
                <input type="checkbox" name="interests[]" id="interestsCars" value="Cars" /><label for="interestsCars" class="opt">Automotive</label>
                <input type="checkbox" name="interests[]" id="interestsTechnology" value="Technology" /><label for="interestsTechnology" class="opt">Technology</label>
            </dd>
        </dl>
        <dl>
        	<dt><label for="languages">Languages:</label></dt>
            <dd>
            	<select size="4" name="languages[]" id="languages" multiple="multiple">
                	<option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Spanish">Spanish</option>
                    <option value="Italian">Italian</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Russian">Russian</option>
                    <option value="Esperanto">Esperanto</option>
                </select>
            </dd>
        </dl>
    </fieldset>
   </form>