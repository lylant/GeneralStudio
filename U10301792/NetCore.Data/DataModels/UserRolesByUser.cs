using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Text;

namespace NetCore.Data.DataModels
{
    public class UserRolesByUser
    {
        [Key, StringLength(50), Column(TypeName = "varchar(50)")]
        public string UserID { get; set; }

        [Key, StringLength(50), Column(TypeName = "varchar(50)")]
        public string RoleID { get; set; }

        [Required]
        public DateTime OwnedDateUTC { get; set; }
    }
}
