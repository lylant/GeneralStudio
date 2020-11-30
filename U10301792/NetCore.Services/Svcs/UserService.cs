using NetCore.Data.DataModels;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace NetCore.Services.Svcs
{
    public class UserService
    {
        #region private methods
        private IEnumerable<User> GetUserInfos()
        {
            return new List<User>()
            {
                new User()
                {
                    UserID = "simonlee",
                    UserName = "Simon Lee",
                    UserEmail = "19978707@student.westernsydney.edu.au",
                    Password = "19978707"
                }
            };
        }

        private bool checkUserInfo(string userID, string password)
        {
            return GetUserInfos().Where(u => u.UserID.Equals(userID) && u.Password.Equals(password)).Any();
        }
        #endregion
    }
}
