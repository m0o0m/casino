
/**
 * Class SoftwareId
 * @author Jeff de Anda
 * 
 * 
 */

/**
 * 
 * @param softwareId
 * @return
 */
function SoftwareId(softwareId)
{
	this.validate(softwareId);
	this.softwareId = softwareId;
	this.productId = softwareId.substring(0, 3);
	this.familyId = softwareId.substring(4,8);
	this.gameTitle = softwareId.substring(4, 10);
	this.paymodelVariant = softwareId.substring(9);
	this.gleGame = softwareId.charAt(4) > 0;
}

/**
 * 
 * @param softwareId
 * @throws String exception message is thrown id softwareId isn't valid.
 */
SoftwareId.prototype.validate = function(softwareId)
{
	var msg = "Invalid softwareId. Expected xxx-xxxx-xxx format (where x is a number), but found " + softwareId + ".";
	
	if(softwareId.length != 12)
		throw msg;
	else if(softwareId.charAt(3) != '-')
		throw msg;
	else if(softwareId.charAt(8) != '-')
		throw msg;
	
	for(var i = 0; i < softwareId.length; i++)
	{
		if(i == 3 || i == 8)
			continue;
		
		var c = softwareId.charAt(i);
		
		if(c >=0 || c <= 9)
			continue;
			
		throw msg;
		
	}

}

/**
 * 
 * @return
 */
SoftwareId.prototype.getProductId = function()
{
	return this.productId;
}

/**
 * 
 * @return
 */
SoftwareId.prototype.getFamilyId = function()
{
	return this.familyId;
}

/**
 * 
 * @return
 */
SoftwareId.prototype.getGameTitle = function()
{
	return this.gameTitle;
}

/**
 * 
 * @return
 */
SoftwareId.prototype.getPaymodelVariant = function()
{
	return this.paymodelVariant;
}

/**
 * 
 * @return
 */
SoftwareId.prototype.isGLEGame = function()
{
	return this.gleGame;
}

/**
 * 
 * @return
 */
SoftwareId.prototype.toString = function()
{
	return this.softwareId;
}
