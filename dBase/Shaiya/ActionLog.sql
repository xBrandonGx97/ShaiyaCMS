USE [PS_GameLog]
GO
/****** Object:  StoredProcedure [dbo].[usp_Insert_Action_Log_E]    Script Date: 12/25/2018 12:37:14 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER  Proc [dbo].[usp_Insert_Action_Log_E]

/*
CAREFUL THIS WILL ALTER YOUR ACTIONLOG 
IF YOU HAVE IMPORTANT SCRIPTS JUST ADD WHAT I HAVE IN HERE
*/

/* 
Created by frsunny@hotmail.com, 2004-08-17
Modified by frsunny@hotmail.com, 2004-08-19

게임내 행동 로그 남기기 */


/*

*/

@UserID varchar(18),
@UserUID int,
@CharID int,
@CharName varchar(50),
@CharLevel tinyint,
@CharExp int,
@MapID smallint,
@PosX real,
@PosY real,
@PosZ real,
@ActionTime datetime,
@ActionType tinyint,
@Value1 bigint = null,
@Value2 int = null,
@Value3 int = null,
@Value4 bigint = null,
@Value5 int = null,
@Value6 int = null,
@Value7 int = null,
@Value8 int = null,
@Value9 int = null,
@Value10 int = null,
@Text1 varchar(100) = '',
@Text2 varchar(100) = '',
@Text3 varchar(100) = '',
@Text4 varchar(100) = '',
@Sql nvarchar(4000) = '',
@yyyy varchar(4) = '',
@mm varchar(2) = '',
@dd varchar(2) = '',
@Bucket smallint = -1

AS

SET @yyyy = datepart(yyyy, @ActionTime)
SET @mm = datepart(mm, @ActionTime)
SET @dd = datepart(dd, @ActionTime)


IF(LEN(@mm) = 1)
BEGIN
	SET @mm = '0' + @mm
END

IF(LEN(@dd) = 1)
BEGIN
	SET @dd = '0' + @dd
END


ELSE IF @ActionType = 173 AND @text2 = 'death' -- boss death, only applies to the ones from the Obelisk.ini
BEGIN	
SET @UserUID = (SELECT TOP 1 UserUID FROM PS_GameData.dbo.Chars WHERE CharName = @text3) 
INSERT INTO CMS_Template.dbo.LOG_BOSS_DEATH VALUES (@Value3, @text1, @UserUID, @text3, @MapID, @PosX, @PosY, @posz, @ActionTime)	
END

-- Admin Panel GM Actions Log Insertion
DECLARE
@row int,@Command varchar(MAX),@PlayerAffected varchar(MAX)=NULL,@CommandResult varchar(MAX) = NULL,@Admin bit,@AdminLevel int

-- Staff Commands List
IF (@ActionType = 180)
BEGIN
 IF (@Text1 = 'VisibleOFF')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1)
  END
 ELSE IF (@Text1 = 'VisibleOn')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1)
  END
 ELSE IF (@Text1 = 'ItemCreate')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, CommandResult)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text3)
  END
 ELSE IF (@Text1 = 'MobCreate')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, CommandResult)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text3)
  END
 ELSE IF (@Text1 = 'FindChar')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, PlayerAffected)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text2)
  END
 ELSE IF (@Text1 = 'MoveChar')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, PlayerAffected, CommandResult)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text2, @Text3)
  END
 ELSE IF (@Text1 = 'CharInfo')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, PlayerAffected)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text2)
  END
 ELSE IF (@Text1 = 'MoveTo')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, PlayerAffected, CommandResult)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text2, @Text3)
  END
 ELSE IF (@Text1 = 'MoveZone')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, CommandResult)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text3)
  END
 ELSE IF (@Text1 = 'NoticeAll')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, CommandResult)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text3)
  END
 ELSE IF (@Text1 = 'SetStatus')
 BEGIN
  INSERT INTO [CMS_Template].[dbo].[LOG_GM_COMMANDS]
   (CharName, MapID, PosX, PosY, ActionTime, Command, CommandResult)
  VALUES
   (@CharName, @MapID, @PosX, @PosY, @ActionTime, @Text1, @Text3)
 END
END

IF @ActionType = '107'
	BEGIN
        UPDATE PS_GameData.dbo.Chars SET Faction = (Select Country FROM PS_GameData.dbo.UserMaxGrow Where UserUID = @UserUID) WHERE UserUID = @UserUID
	END 

IF @ActionType = '108'
	BEGIN
        UPDATE PS_GameData.dbo.Chars SET Faction = (Select Country FROM PS_GameData.dbo.UserMaxGrow Where UserUID = @UserUID) WHERE UserUID = @UserUID
	END

  /*Stat Padders*/
  DECLARE
@DIP varchar (100),
@UID varchar (100),
@KIP Varchar (100)

IF (@ActionType = 103)

BEGIN
SELECT @UID = um.UserID FROM PS_UserData.dbo.Users_Master as um 
INNER JOIN PS_GameData.dbo.Chars as c ON c.UserUID = um.UserUID 
inner join PS_GameLog.dbo.ActionLog as a  on a.Value1 = c.CharID Where c.CharID = @Value1 AND ActionType = 103

SELECT @KIP = um.UserIp FROM PS_UserData.dbo.Users_Master as um 
INNER JOIN PS_GameData.dbo.Chars as c ON c.UserUID = um.UserUID 
inner join PS_GameLog.dbo.ActionLog as a  on a.Value1 = c.CharID Where c.CharID = @Value1 AND ActionType = 103

Select @DIP = um.UserIP FROM PS_UserData.dbo.Users_Master as um
INNER JOIN PS_GameLog.dbo.ActionLog as a on um.UserID = a.UserID WHERE um.UserID=@UserID AND ActionType = 103

IF @DIP = @KIP
	
INSERT INTO ShaiyaCMS.dbo.StatPadders (DeadToon,DeadIP,DeadID,KillerToon,KillerIP,KillerID,Date,Map)
VALUES (@Text1,@KIP,@UID,@CharName,@DIP,@UserID,@ActionTime,@MapID)
END

  /* Login - Logout replacement for players online */
IF @ActionType = '108'
	BEGIN
        UPDATE PS_GameData.dbo.Chars SET [LoginStatus]=0 WHERE PS_GameData.dbo.Chars.CharID=@CharID 	
	END
IF @ActionType = '107'
	BEGIN
        UPDATE PS_GameData.dbo.Chars SET [LoginStatus]=1 WHERE PS_GameData.dbo.Chars.CharID=@CharID		
    END 

SET @Sql = N'
INSERT INTO PS_GameLog.dbo.ActionLog
(UserID, UserUID, CharID, CharName, CharLevel, CharExp, MapID,  PosX, PosY, PosZ, ActionTime, ActionType, 
Value1, Value2, Value3, Value4, Value5, Value6, Value7, Value8, Value9, Value10, Text1, Text2, Text3, Text4)
VALUES(@UserID, @UserUID, @CharID, @CharName, @CharLevel, @CharExp, @MapID, @PosX, @PosY, @PosZ, @ActionTime, @ActionType, 
@Value1, @Value2, @Value3, @Value4, @Value5, @Value6, @Value7, @Value8, @Value9, @Value10, @Text1, @Text2, @Text3, @Text4)'

EXEC sp_executesql @Sql, 
N'@UserID varchar(18), @UserUID int, @CharID int, @CharName varchar(50), 
@CharLevel tinyint, @CharExp int, @MapID smallint, @PosX real, @PosY real, @PosZ real, @ActionTime datetime, @ActionType tinyint, 
@Value1 bigint, @Value2 int, @Value3 int, @Value4 bigint, @Value5 int, @Value6 int, @Value7 int, @Value8 int, 
@Value9 int, @Value10 int, @Text1 varchar(100), @Text2 varchar(100), @Text3 varchar(100), @Text4 varchar(100)',
@UserID, @UserUID, @CharID, @CharName, @CharLevel, @CharExp, @MapID, @PosX, @PosY, @PosZ, @ActionTime, @ActionType, 
@Value1, @Value2, @Value3, @Value4, @Value5, @Value6, @Value7, @Value8, @Value9, @Value10, @Text1, @Text2, @Text3, @Text4

