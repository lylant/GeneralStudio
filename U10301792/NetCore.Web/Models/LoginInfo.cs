using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.ComponentModel.DataAnnotations;

namespace NetCore.Web.Models
{
    public class LoginInfo
    {
        [Display(Name = "User ID")]
        [Required(ErrorMessage = "User ID must be provided.")]
        [MinLength(6)]
        public string UserID { get; set; }

        [Display(Name = " Password")]
        [Required]
        public string Password { get; set; }
    }
}
